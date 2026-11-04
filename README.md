# PredictorMT

PredictorMT is a Laravel application for industrial machine monitoring, sensor data, alerts, maintenance tasks, and machinery simulation.

## Local setup

Requirements: PHP 8.1+, Composer, and MySQL/MariaDB (SQLite is used for automated tests).

1. Install PHP dependencies:

   ```powershell
   composer install
   ```

2. Create the local environment file and application key:

   ```powershell
   Copy-Item .env.example .env
   php artisan key:generate
   ```

3. Configure `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`.
4. Create the configured database, then run:

   ```powershell
   php artisan migrate --seed
   php artisan serve
   ```

5. Open the URL printed by `php artisan serve`.

Do not run schema migrations against a production database until its backup and migration history have been checked.

## Simulation

Sign in to a company account, create a machine, then open **Simulation**. Choose a machine, scenario, speed, thresholds, and temperature calibration offset. Start, pause, or stop the simulation. Running simulations generate and store one sensor reading per minute in the background; the page refreshes its display every two seconds.

The Laravel scheduler runs the `simulations:tick` command every minute. For local development, keep this process running in a terminal:

```powershell
php artisan schedule:work
```

On a production server, configure the system scheduler to run `php artisan schedule:run` every minute. Without a running scheduler, simulations remain marked as running but do not generate background readings.

The company dashboard refreshes its sensor summary, machine KPIs, and latest eight alert events every five seconds. Active sensors with a reading within the last five minutes count as connected; active sensors with no recent reading are shown as stale.

The generator includes temperature, pressure, humidity, vibration, RPM, voltage, current, power, energy, and flow rate. Scenarios cover normal operation, stress, common machine faults, communication/sensor faults, shutdown, and maintenance events. The machine-state control can mark a simulation ready, in maintenance, faulted, or emergency-stopped; maintenance and fault pause generation, while emergency stop halts it. Starting and stopping are shown as transition states until the next scheduler run. Select Ready before restarting after a maintenance, fault, or emergency-stop state. Readings are saved in `sensor_readings`; their JSON `payload` contains a `values` object, units, scenario, and sequence. Fault scenarios create an alert and maintenance task. Configured threshold crossings create one critical alert per threshold for each run.

## Admin system configuration

Administrators can open **Admin → Settings** to configure the default simulation scenario and speed, as well as temperature, pressure, humidity, and vibration alert thresholds. Saved values are persisted in the `application_settings` table and prefill the simulation controls. The default scenario and speed are also used when an API request starts a simulation without specifying them. If no settings have been saved, the defaults in `config/predictor.php` are used. MQTT broker credentials and connection details remain in environment configuration and are not stored in the database.

Simulation users can replay stored sensor readings by selecting a machine and date/time range in **Historical playback**. Results are returned in timestamp order, scoped to the user's company, and capped at 1,000 readings per request.

## HTTP sensor ingestion

The endpoint accepts authenticated Laravel Sanctum personal access tokens. The payload must contain only the `values` object; send scenario and display metadata separately only if a future API version explicitly supports them.

```http
POST /api/sensor-readings
Authorization: Bearer <personal-access-token>
Content-Type: application/json
Accept: application/json
```

Example request:

```json
{
  "sensor_id": 12,
  "timestamp": "2026-11-03T08:30:00Z",
  "payload": {
    "values": {
      "temperature": 72.5,
      "pressure": 118.2,
      "humidity": 46,
      "vibration": 2.8,
      "energy": 16.4
    }
  }
}
```

At least one numeric value is required. Supported measurement names are `temperature`, `pressure`, `humidity`, `vibration`, `rpm`, `voltage`, `current`, `power`, `energy`, and `flow_rate`. The authenticated user must belong to the company that owns the sensor's machine.

Issue a token for a user from a trusted local shell with Tinker, and store the returned token securely:

```powershell
php artisan tinker
```

```php
App\Models\User::findOrFail(1)->createToken('sensor-gateway')->plainTextToken;
```

## MQTT integration

MQTT is optional and disabled by default. Configure `MQTT_ENABLED`, `MQTT_HOST`, `MQTT_PORT`, and, if required, `MQTT_USERNAME`, `MQTT_PASSWORD`, and `MQTT_USE_TLS` in `.env`. Never commit broker credentials.

- Simulation readings are published at QoS 1 to `MQTT_PUBLISH_TOPIC` (default: `predictormt/simulated/{device_id}/readings`).
- The subscriber listens on `MQTT_SUBSCRIBE_TOPIC` (default: `predictormt/sensors/+/readings`). Messages use the HTTP payload shape with `device_id`, optional `timestamp`, and `payload.values`.
- Run the subscriber as a long-lived process with `php artisan mqtt:listen-sensor-readings`. It accepts messages only for known, machine-assigned sensors and logs malformed or unmatched messages.
- Check the configured broker from a terminal with `php artisan mqtt:check-connection`. The command reports an error if MQTT is disabled or the broker connection fails.
- HTTP ingestion remains available when MQTT is disabled.

The automated MQTT tests use a fake broker client to verify the publish topic, message, QoS, subscriber validation path, and database storage. They do not prove that a real broker, credentials, TLS certificate, firewall, or production worker is configured correctly; run the connection check against your broker before calling the integration ready.

## Beginner verification flow

1. Run `php artisan test` to check the application behavior against the test database.
2. Sign in, create a company machine and sensor, then open the **Simulation** page.
3. Start a simulation, wait for the next minute, and check that a new reading appears. Use `php artisan schedule:work` in a second terminal while testing.
4. Pause the simulation and wait for another scheduler run. Confirm the reading count does not increase. Set the machine to **Ready** before starting again after maintenance or a fault.
5. Open **Admin → Settings**, change the default scenario or speed, save, then open the simulation page and confirm the values are preselected.
6. Open the dashboard and check that recent sensors show as connected and sensors that have not reported in five minutes show as stale.
7. To test HTTP ingestion, create a Sanctum token for a user in the sensor's company and send the documented `POST /api/sensor-readings` request.
8. To test MQTT, configure broker values in `.env`, set `MQTT_ENABLED=true`, clear cached config with `php artisan config:clear`, then run `php artisan mqtt:check-connection`. In separate terminals, run the subscriber and publish one valid sample message; confirm the new reading in the dashboard or simulation history.
9. Before deployment, run the test suite, back up the database, configure the production environment and scheduler, and repeat the HTTP/MQTT checks against the production broker. Get user acceptance and deployment sign-off from the project owner; these environment-dependent steps cannot be verified by local automated tests.

## Basic system flow

1. A user creates a company, machine, and sensor in the application.
2. A simulation or an external sensor sends measurements to the application.
3. The application stores each measurement with its machine and sensor IDs.
4. The dashboard reads stored measurements and company alerts; the history screen replays readings for a selected time range.
5. Admins set shared default simulation behavior and alert thresholds. Broker secrets stay in the server `.env` file.

## Deployment checklist

1. Back up the database and application files before deploying.
2. Set production `APP_ENV=production`, `APP_DEBUG=false`, a private `APP_KEY`, database details, and any required MQTT settings. Do not copy development credentials into production.
3. Install Composer dependencies and run migrations only after checking the deployment plan and database backup.
4. Run `php artisan config:cache` and `php artisan route:cache` if the server deployment uses cached configuration and routes.
5. Configure the operating system scheduler to run `php artisan schedule:run` every minute. Confirm it runs as the application user.
6. If MQTT is enabled, verify `php artisan mqtt:check-connection`, then keep `php artisan mqtt:listen-sensor-readings` running under the server's process manager.
7. Check Laravel logs, dashboard readings, and alert behavior after deployment. Keep a rollback plan.

## User acceptance checklist

Ask a representative user to verify that they can:

- Sign in and see only their company's machines, sensors, readings, and alerts.
- Start, pause, stop, and replay a simulation; confirm maintenance/fault/emergency-stop states behave as described.
- Receive HTTP readings for an assigned sensor and see them in history/dashboard.
- See a stale active sensor reported as stale when it has not checked in recently.
- Acknowledge and review alerts using the existing alert screens.

Record the tester, date, any defects, and the project owner's approval outside the development environment. A passing automated test suite is not UAT sign-off.

## Troubleshooting

- **Simulation has no new readings:** Confirm it is Running, start `php artisan schedule:work` locally (or check the server scheduler), and inspect Laravel logs.
- **MQTT command says disabled:** Set `MQTT_ENABLED=true` in `.env`, then run `php artisan config:clear`.
- **MQTT connection fails:** Check the broker host/port, username/password, TLS setting, firewall, and broker service before retrying the connection command.
- **MQTT connects but no readings arrive:** Confirm the subscriber is running, the device ID exists and is assigned to a machine, the topic matches the configured subscription, and the JSON message has `device_id` and `payload.values`.
- **HTTP ingestion returns 401/403:** Check the Sanctum token and confirm its user belongs to the company that owns the sensor.
- **Settings changes do not appear:** Reload the page and check for validation errors; for environment changes, clear cached config.

## Tests

Tests use an isolated in-memory SQLite database:

```powershell
php artisan test
```
