<?php

namespace App\Services;

use Illuminate\Support\Str;
use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\Contracts\MqttClient as MqttClientContract;
use PhpMqtt\Client\MqttClient;

class MqttClientFactory
{
    public function connect(): MqttClientContract
    {
        $client = new MqttClient(
            config('mqtt.host'),
            config('mqtt.port'),
            config('mqtt.client_id').'-'.Str::uuid()
        );
        $settings = (new ConnectionSettings)
            ->setConnectTimeout(config('mqtt.connect_timeout'))
            ->setUseTls(config('mqtt.use_tls'));

        if (config('mqtt.username') !== null && config('mqtt.username') !== '') {
            $settings = $settings
                ->setUsername(config('mqtt.username'))
                ->setPassword(config('mqtt.password'));
        }

        $client->connect($settings, true);

        return $client;
    }
}
