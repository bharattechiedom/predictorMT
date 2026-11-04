<?php

return [
    'enabled' => (bool) env('MQTT_ENABLED', false),
    'host' => env('MQTT_HOST', '127.0.0.1'),
    'port' => (int) env('MQTT_PORT', 1883),
    'username' => env('MQTT_USERNAME'),
    'password' => env('MQTT_PASSWORD'),
    'client_id' => env('MQTT_CLIENT_ID', 'predictormt'),
    'use_tls' => (bool) env('MQTT_USE_TLS', false),
    'connect_timeout' => (int) env('MQTT_CONNECT_TIMEOUT', 5),
    'retries' => (int) env('MQTT_RETRIES', 3),
    'retry_delay_ms' => (int) env('MQTT_RETRY_DELAY_MS', 250),
    'publish_topic' => env('MQTT_PUBLISH_TOPIC', 'predictormt/simulated/{device_id}/readings'),
    'subscribe_topic' => env('MQTT_SUBSCRIBE_TOPIC', 'predictormt/sensors/+/readings'),
];
