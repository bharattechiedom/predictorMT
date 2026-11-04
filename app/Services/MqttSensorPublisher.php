<?php

namespace App\Services;

use App\Models\SensorReading;
use PhpMqtt\Client\MqttClient;

class MqttSensorPublisher
{
    public function __construct(private MqttClientFactory $clients) {}

    public function publish(SensorReading $reading): void
    {
        if (! config('mqtt.enabled')) {
            return;
        }

        $reading->loadMissing('sensor');
        $sensor = $reading->sensor;

        if (! $sensor) {
            throw new \RuntimeException('Cannot publish a sensor reading without its sensor.');
        }

        retry(config('mqtt.retries'), function () use ($reading, $sensor): void {
            $client = null;
            try {
                $client = $this->clients->connect();
                $topic = str_replace('{device_id}', $sensor->device_id, config('mqtt.publish_topic'));
                $client->publish($topic, json_encode([
                    'device_id' => $sensor->device_id,
                    'machine_id' => $reading->machine_id,
                    'timestamp' => $reading->timestamp?->toIso8601String(),
                    'payload' => ['values' => $reading->payload['values'] ?? []],
                ], JSON_THROW_ON_ERROR), MqttClient::QOS_AT_LEAST_ONCE);
                $client->loop(true, true);
            } finally {
                if ($client !== null) {
                    $client->disconnect();
                }
            }
        }, config('mqtt.retry_delay_ms'));
    }
}
