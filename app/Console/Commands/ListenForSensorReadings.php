<?php

namespace App\Console\Commands;

use App\Models\Sensor;
use App\Services\MqttClientFactory;
use App\Services\SensorReadingIngestionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use JsonException;
use PhpMqtt\Client\MqttClient;

class ListenForSensorReadings extends Command
{
    protected $signature = 'mqtt:listen-sensor-readings';

    protected $description = 'Listen for authenticated sensor readings from the configured MQTT broker';

    public function handle(MqttClientFactory $clients, SensorReadingIngestionService $ingestion): int
    {
        if (! config('mqtt.enabled')) {
            $this->error('Set MQTT_ENABLED=true and configure the broker before starting the MQTT subscriber.');

            return self::FAILURE;
        }

        $client = $clients->connect();

        try {
            $client->subscribe(
                config('mqtt.subscribe_topic'),
                function (string $topic, string $message) use ($ingestion): void {
                    $this->ingestMessage($topic, $message, $ingestion);
                },
                MqttClient::QOS_AT_LEAST_ONCE
            );
            $this->info('Listening on '.config('mqtt.subscribe_topic'));
            $client->loop(true);
        } finally {
            $client->disconnect();
        }

        return self::SUCCESS;
    }

    private function ingestMessage(string $topic, string $message, SensorReadingIngestionService $ingestion): void
    {
        try {
            $data = json_decode($message, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            Log::warning('Discarded an invalid JSON MQTT sensor message.', ['topic' => $topic]);

            return;
        }

        if (! is_array($data)) {
            Log::warning('Discarded an MQTT sensor message with a non-object JSON payload.', ['topic' => $topic]);

            return;
        }

        $validated = Validator::make($data, [
            'device_id' => ['required', 'string', 'max:100'],
            'timestamp' => ['nullable', 'date'],
            'payload' => ['required', 'array:values'],
            'payload.values' => ['required', 'array:temperature,pressure,humidity,vibration,rpm,voltage,current,power,energy,flow_rate', 'min:1'],
            'payload.values.temperature' => ['nullable', 'numeric'],
            'payload.values.pressure' => ['nullable', 'numeric'],
            'payload.values.humidity' => ['nullable', 'numeric'],
            'payload.values.vibration' => ['nullable', 'numeric'],
            'payload.values.rpm' => ['nullable', 'numeric'],
            'payload.values.voltage' => ['nullable', 'numeric'],
            'payload.values.current' => ['nullable', 'numeric'],
            'payload.values.power' => ['nullable', 'numeric'],
            'payload.values.energy' => ['nullable', 'numeric'],
            'payload.values.flow_rate' => ['nullable', 'numeric'],
        ]);

        if ($validated->fails()) {
            Log::warning('Discarded an invalid MQTT sensor message.', [
                'topic' => $topic,
                'errors' => $validated->errors()->keys(),
            ]);

            return;
        }

        $data = $validated->validated();
        if (! array_filter($data['payload']['values'], 'is_numeric')) {
            Log::warning('Discarded an MQTT sensor message without numeric readings.', ['topic' => $topic]);

            return;
        }

        $expectedTopic = str_replace('+', $data['device_id'], config('mqtt.subscribe_topic'));

        if ($topic !== $expectedTopic) {
            Log::warning('Discarded an MQTT message whose device ID does not match its topic.', [
                'topic' => $topic,
            ]);

            return;
        }

        $sensor = Sensor::with('machine')->where('device_id', $data['device_id'])->first();

        if (! $sensor || ! $sensor->machine) {
            Log::warning('Discarded an MQTT reading for an unknown or unassigned sensor.', [
                'device_id' => $data['device_id'],
            ]);

            return;
        }

        $ingestion->store($sensor, $data['payload'], $data['timestamp'] ?? null, 'mqtt');
    }
}
