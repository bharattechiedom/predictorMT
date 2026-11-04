@include('admin.include.header')

<main class="admin-page-content">
    <div class="container-fluid admin-layout">
        <div class="row">
            @include('admin.include.sidebar-nav')

            <div class="col-12 col-md-9 col-lg-10 dashboard-wrapper">
                <div class="main-content p-3 p-lg-4">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                        <div>
                            <h4 class="fw-bold mb-1">System Configuration</h4>
                            <p class="text-secondary mb-0">Manage default simulation behavior and alert thresholds.</p>
                        </div>
                        <span class="badge rounded-pill {{ $mqttEnabled ? 'bg-success' : 'bg-secondary' }} px-3 py-2">
                            MQTT {{ $mqttEnabled ? 'enabled' : 'disabled' }}
                        </span>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success" role="status">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-4">
                            <h5 class="fw-bold mb-1">Default alert thresholds</h5>
                            <p class="text-secondary small mb-0">
                                These values prefill each new simulation and are used whenever a simulation does not specify a threshold.
                            </p>
                        </div>
                        <div class="card-body p-4 border-top">
                            <form method="POST" action="{{ route('admin.settings.update') }}">
                                @csrf
                                @method('PUT')

                                <h6 class="fw-bold mb-3">Default simulation behavior</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="simulation_scenario" class="form-label">Default scenario</label>
                                        <select id="simulation_scenario" name="simulation_defaults[scenario]" class="form-select" required>
                                            @foreach ($scenarios as $value => $label)
                                                <option value="{{ $value }}" @selected(old('simulation_defaults.scenario', $simulationDefaults['scenario']) === $value)>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="simulation_speed" class="form-label">Default simulation speed</label>
                                        <select id="simulation_speed" name="simulation_defaults[speed]" class="form-select" required>
                                            @foreach ([1, 2, 5, 10, 20] as $speed)
                                                <option value="{{ $speed }}" @selected((int) old('simulation_defaults.speed', $simulationDefaults['speed']) === $speed)>
                                                    {{ $speed }}x
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <h6 class="fw-bold mb-3">Default alert thresholds</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="temperature_max" class="form-label">Temperature maximum (°C)</label>
                                        <input id="temperature_max" name="thresholds[temperature_max]" type="number"
                                               class="form-control" min="30" max="200" step="0.1" required
                                               value="{{ old('thresholds.temperature_max', $thresholds['temperature_max']) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pressure_min" class="form-label">Pressure minimum (PSI)</label>
                                        <input id="pressure_min" name="thresholds[pressure_min]" type="number"
                                               class="form-control" min="0" max="500" step="0.1" required
                                               value="{{ old('thresholds.pressure_min', $thresholds['pressure_min']) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="humidity_max" class="form-label">Humidity maximum (%)</label>
                                        <input id="humidity_max" name="thresholds[humidity_max]" type="number"
                                               class="form-control" min="0" max="100" step="0.1" required
                                               value="{{ old('thresholds.humidity_max', $thresholds['humidity_max']) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vibration_max" class="form-label">Vibration maximum (mm/s)</label>
                                        <input id="vibration_max" name="thresholds[vibration_max]" type="number"
                                               class="form-control" min="0" max="100" step="0.1" required
                                               value="{{ old('thresholds.vibration_max', $thresholds['vibration_max']) }}">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                                    <button type="submit" class="btn theme-btn">
                                        <i class="fa-solid fa-floppy-disk me-2"></i>Save configuration
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4 mb-0">
                        <h6 class="alert-heading">MQTT broker settings</h6>
                        <p class="mb-2">Broker connection details are read from the server's environment settings. Passwords are never shown or stored in this page.</p>
                        <dl class="row small mb-2">
                            <dt class="col-sm-3">Broker</dt>
                            <dd class="col-sm-9">{{ $mqttConfiguration['host'] }}:{{ $mqttConfiguration['port'] }} (TLS {{ $mqttConfiguration['use_tls'] ? 'on' : 'off' }})</dd>
                            <dt class="col-sm-3">Publish topic</dt>
                            <dd class="col-sm-9"><code>{{ $mqttConfiguration['publish_topic'] }}</code></dd>
                            <dt class="col-sm-3">Subscribe topic</dt>
                            <dd class="col-sm-9"><code>{{ $mqttConfiguration['subscribe_topic'] }}</code></dd>
                        </dl>
                        <p class="mb-0">To test broker access, run <code>php artisan mqtt:check-connection</code> on the application server.</p>
                    </div>
                    <p class="text-secondary small mt-3 mb-0">
                        Signed in as {{ $admin->name ?? $admin->email }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.include.footer')
