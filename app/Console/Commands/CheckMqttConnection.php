<?php

namespace App\Console\Commands;

use App\Services\MqttClientFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Exceptions\MqttClientException;

class CheckMqttConnection extends Command
{
    protected $signature = 'mqtt:check-connection';

    protected $description = 'Check whether the configured MQTT broker is reachable';

    public function handle(MqttClientFactory $clients): int
    {
        if (! config('mqtt.enabled')) {
            $this->error('MQTT is disabled. Set MQTT_ENABLED=true in .env first.');

            return self::FAILURE;
        }

        try {
            $client = $clients->connect();
            $client->disconnect();
        } catch (MqttClientException $exception) {
            Log::warning('MQTT broker connection check failed.', [
                'host' => config('mqtt.host'),
                'port' => config('mqtt.port'),
                'exception' => get_class($exception),
            ]);
            $this->error('Could not connect to the MQTT broker at '.config('mqtt.host').':'.config('mqtt.port').'. Check the host, port, credentials, TLS setting, and firewall.');

            return self::FAILURE;
        }

        $this->info('MQTT broker connection successful.');

        return self::SUCCESS;
    }
}
