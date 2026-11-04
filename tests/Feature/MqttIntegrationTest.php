<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Machine;
use App\Models\Sensor;
use App\Models\SensorReading;
use App\Models\User;
use App\Services\MqttClientFactory;
use App\Services\MqttSensorPublisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use PhpMqtt\Client\Contracts\MqttClient;
use PhpMqtt\Client\Exceptions\ConnectingToBrokerFailedException;
use PhpMqtt\Client\MqttClient as PhpMqttClient;
use Tests\TestCase;

class MqttIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_simulation_reading_is_published_to_the_device_topic(): void
    {
        config([
            'mqtt.enabled' => true,
            'mqtt.publish_topic' => 'predictormt/simulated/{device_id}/readings',
        ]);
        $sensor = $this->createSensor();
        $reading = SensorReading::create([
            'sensor_id' => $sensor->id,
            'machine_id' => $sensor->machine_id,
            'timestamp' => now(),
            'payload' => ['values' => ['temperature' => 72.5]],
            'value_float' => 72.5,
        ]);
        $client = Mockery::mock(MqttClient::class);
        $client->shouldReceive('publish')
            ->once()
            ->withArgs(function (string $topic, string $message, int $qos): bool {
                $data = json_decode($message, true);

                return $topic === 'predictormt/simulated/DEVICE-1/readings'
                    && $qos === PhpMqttClient::QOS_AT_LEAST_ONCE
                    && $data['device_id'] === 'DEVICE-1'
                    && $data['payload']['values']['temperature'] === 72.5
                    && array_keys($data['payload']) === ['values'];
            });
        $client->shouldReceive('loop')->once()->with(true, true);
        $client->shouldReceive('disconnect')->once();

        $this->mock(MqttClientFactory::class)
            ->shouldReceive('connect')
            ->once()
            ->andReturn($client);

        app(MqttSensorPublisher::class)->publish($reading);
    }

    public function test_mqtt_subscriber_stores_a_valid_device_reading(): void
    {
        config([
            'mqtt.enabled' => true,
            'mqtt.subscribe_topic' => 'predictormt/sensors/+/readings',
        ]);
        $this->createSensor();
        $client = Mockery::mock(MqttClient::class);
        $client->shouldReceive('subscribe')
            ->once()
            ->withArgs(function (string $topic, callable $callback, int $qos): bool {
                $this->assertSame('predictormt/sensors/+/readings', $topic);
                $callback(
                    'predictormt/sensors/DEVICE-1/readings',
                    json_encode([
                        'device_id' => 'DEVICE-1',
                        'payload' => ['values' => ['temperature' => 73.2]],
                    ], JSON_THROW_ON_ERROR)
                );

                return $qos === PhpMqttClient::QOS_AT_LEAST_ONCE;
            });
        $client->shouldReceive('loop')->once()->with(true);
        $client->shouldReceive('disconnect')->once();

        $this->mock(MqttClientFactory::class)
            ->shouldReceive('connect')
            ->once()
            ->andReturn($client);

        $this->artisan('mqtt:listen-sensor-readings')->assertSuccessful();

        $this->assertDatabaseHas('sensor_readings', [
            'sensor_id' => Sensor::where('device_id', 'DEVICE-1')->value('id'),
            'payload->source' => 'mqtt',
            'value_float' => 73.2,
        ]);
    }

    public function test_mqtt_connection_check_reports_disabled_configuration(): void
    {
        config(['mqtt.enabled' => false]);

        $this->artisan('mqtt:check-connection')
            ->expectsOutput('MQTT is disabled. Set MQTT_ENABLED=true in .env first.')
            ->assertFailed();
    }

    public function test_mqtt_connection_check_explains_when_the_broker_cannot_be_reached(): void
    {
        config([
            'mqtt.enabled' => true,
            'mqtt.host' => 'broker.example.test',
            'mqtt.port' => 1883,
        ]);
        $this->mock(MqttClientFactory::class)
            ->shouldReceive('connect')
            ->once()
            ->andThrow(new ConnectingToBrokerFailedException(
                ConnectingToBrokerFailedException::EXCEPTION_CONNECTION_FAILED,
                'Connection refused.'
            ));

        $this->artisan('mqtt:check-connection')
            ->expectsOutput('Could not connect to the MQTT broker at broker.example.test:1883. Check the host, port, credentials, TLS setting, and firewall.')
            ->assertFailed();
    }

    public function test_mqtt_subscriber_rejects_unexpected_payload_fields(): void
    {
        config([
            'mqtt.enabled' => true,
            'mqtt.subscribe_topic' => 'predictormt/sensors/+/readings',
        ]);
        $sensor = $this->createSensor();
        $client = Mockery::mock(MqttClient::class);
        $client->shouldReceive('subscribe')
            ->once()
            ->withArgs(function (string $topic, callable $callback): bool {
                $callback(
                    'predictormt/sensors/DEVICE-1/readings',
                    json_encode([
                        'device_id' => 'DEVICE-1',
                        'payload' => [
                            'values' => ['temperature' => 73.2],
                            'scenario' => '<script>alert(1)</script>',
                        ],
                    ], JSON_THROW_ON_ERROR)
                );

                return $topic === 'predictormt/sensors/+/readings';
            });
        $client->shouldReceive('loop')->once()->with(true);
        $client->shouldReceive('disconnect')->once();

        $this->mock(MqttClientFactory::class)
            ->shouldReceive('connect')
            ->once()
            ->andReturn($client);

        $this->artisan('mqtt:listen-sensor-readings')->assertSuccessful();

        $this->assertSame(0, SensorReading::where('sensor_id', $sensor->id)->count());
    }

    private function createSensor(): Sensor
    {
        $company = Company::create(['name' => 'MQTT Test Company']);
        User::create([
            'company_id' => $company->id,
            'name' => 'MQTT Test User',
            'email' => 'mqtt-test@example.test',
            'password' => 'password',
            'role' => 'viewer',
        ]);
        $machine = Machine::create([
            'company_id' => $company->id,
            'name' => 'MQTT Test Machine',
            'machine_type' => 'Motor',
            'status' => 'healthy',
        ]);

        return Sensor::create([
            'device_id' => 'DEVICE-1',
            'machine_id' => $machine->id,
            'sensor_type' => 'temperature',
            'status' => 'active',
        ]);
    }
}
