<?php $page_title = 'Machine simulation'; ?>
@include('user.include.header')

<main class="main-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('user.include.sidebar-nav')
            </div>
            <div class="col-md-10">
                <div class="page-content dashboard-page m-auto p-3 mt-5">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                        <div>
                            <h3 class="mb-1 fw-bold">Machinery Simulation</h3>
                            <p class="text-muted mb-0">Running simulations generate readings in the background once per minute.</p>
                        </div>
                        <div class="d-flex gap-2 badge_padding">
                            <span id="simulation-status" class="badge text-bg-secondary p-1">Stopped</span>
                            <span id="operating-state" class="badge text-bg-secondary p-1">Stopped</span>
                        </div>
                    </div>

                    @if ($machines->isEmpty())
                        <div class="alert alert-info">
                            Add a machine to your company before starting a simulation.
                            <a href="{{ route('user.machines.create') }}" class="alert-link">Create a machine</a>
                        </div>
                    @else
                        @php
                            $runningCount = $machines->filter(fn ($machine) => data_get($machine->metadata, 'simulation.status') === 'running')->count();
                            $faultCount = $machines->filter(fn ($machine) => !in_array(data_get($machine->metadata, 'simulation.scenario', 'normal'), ['normal', 'stress_test'], true))->count();
                        @endphp

                        <div class="row g-3 mb-4">
                            <div class="col-sm-6 col-xl-3">
                                <div class="card h-100"><div class="card-body">
                                    <div class="text-muted">Company machines</div>
                                    <div class="fs-3 fw-bold">{{ $machines->count() }}</div>
                                </div></div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="card h-100"><div class="card-body">
                                    <div class="text-muted">Running simulations</div>
                                    <div class="fs-3 fw-bold text-success" id="running-count">{{ $runningCount }}</div>
                                </div></div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="card h-100"><div class="card-body">
                                    <div class="text-muted">Machines with fault scenario</div>
                                    <div class="fs-3 fw-bold text-warning">{{ $faultCount }}</div>
                                </div></div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="card h-100"><div class="card-body">
                                    <div class="text-muted">Generated readings</div>
                                    <div class="fs-3 fw-bold" id="reading-count">0</div>
                                </div></div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header pb-0"><h4 class="mb-0 pb-0">Simulation controls</h4></div>
                            <div class="card-body">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-4">
                                        <label for="machine-select" class="form-label">Machine</label>
                                        <select id="machine-select" class="form-select">
                                            @foreach ($machines as $machine)
                                                <option value="{{ $machine->id }}" data-status="{{ data_get($machine->metadata, 'simulation.status', 'stopped') }}"
                                                        data-operating-state="{{ data_get($machine->metadata, 'simulation.operating_state', data_get($machine->metadata, 'simulation.status', 'stopped')) }}">
                                                    {{ $machine->name }} ({{ $machine->machine_type }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="scenario-select" class="form-label">Scenario</label>
                                        <select id="scenario-select" class="form-select">
                                            @foreach ($scenarios as $value => $label)
                                                <option value="{{ $value }}" @selected($simulationDefaults['scenario'] === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="speed-select" class="form-label">Speed</label>
                                        <select id="speed-select" class="form-select">
                                            @foreach ([1, 2, 5, 10, 20] as $speed)
                                                <option value="{{ $speed }}" @selected((int) $simulationDefaults['speed'] === $speed)>{{ $speed }}x</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-success flex-fill" data-action="start">Start</button>
                                            <button type="button" class="btn btn-warning flex-fill" data-action="pause">Pause</button>
                                            <button type="button" class="btn btn-danger flex-fill" data-action="stop">Stop</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mt-1 align-items-end">
                                    <div class="col-md-4">
                                        <label for="operating-state-select" class="form-label">Machine state</label>
                                        <select id="operating-state-select" class="form-select">
                                            <option value="ready">Ready</option>
                                            <option value="maintenance">Maintenance</option>
                                            <option value="fault">Fault</option>
                                            <option value="emergency_stop">Emergency stop</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button id="set-operating-state" type="button" class="btn btn-outline-warning">Update machine state</button>
                                    </div>
                                    <div class="col-md-5 small text-muted">
                                        Maintenance, fault, and emergency-stop states pause or stop reading generation. Set the machine to Ready before starting it again.
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-md-3">
                                        <label for="temperature-threshold" class="form-label">Temperature max (°C)</label>
                                        <input id="temperature-threshold" class="form-control" type="number" min="30" max="200" value="{{ $defaultThresholds['temperature_max'] }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="pressure-threshold" class="form-label">Pressure min (PSI)</label>
                                        <input id="pressure-threshold" class="form-control" type="number" min="0" max="500" value="{{ $defaultThresholds['pressure_min'] }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="humidity-threshold" class="form-label">Humidity max (%)</label>
                                        <input id="humidity-threshold" class="form-control" type="number" min="0" max="100" value="{{ $defaultThresholds['humidity_max'] }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="vibration-threshold" class="form-label">Vibration max</label>
                                        <input id="vibration-threshold" class="form-control" type="number" min="0" max="100" step="0.1" value="{{ $defaultThresholds['vibration_max'] }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="temperature-offset" class="form-label">Temp. calibration (°C)</label>
                                        <input id="temperature-offset" class="form-control" type="number" min="-10" max="10" step="0.1" value="0">
                                    </div>
                                </div>
                                <div id="simulation-message" class="small mt-3" role="status" aria-live="polite"></div>
                                <form class="d-none">@csrf</form>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header pb-0"><h4 class="mb-0">Historical playback</h4></div>
                            <div class="card-body">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-2">
                                        <label for="history-from" class="form-label">From</label>
                                        <input id="history-from" type="datetime-local" class="form-control"
                                               value="{{ now()->subDay()->format('Y-m-d\TH:i') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="history-to" class="form-label">To</label>
                                        <input id="history-to" type="datetime-local" class="form-control"
                                               value="{{ now()->format('Y-m-d\TH:i') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button id="history-load" type="button" class="btn btn-outline-primary w-100">Load readings</button>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="history-speed" class="form-label">Playback speed</label>
                                        <select id="history-speed" class="form-select">
                                            <option value="0.25">0.25x</option>
                                            <option value="0.5">0.5x</option>
                                            <option value="1" selected>1x</option>
                                            <option value="2">2x</option>
                                            <option value="5">5x</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="d-flex gap-2">
                                            <button id="history-play" type="button" class="btn btn-success flex-fill" disabled>Play</button>
                                            <button id="history-pause" type="button" class="btn btn-warning flex-fill" disabled>Pause</button>
                                            <button id="history-stop" type="button" class="btn btn-secondary flex-fill" disabled>Stop</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="history-position" class="form-label">Reading position</label>
                                    <input id="history-position" type="range" class="form-range" min="0" max="0" value="0" disabled>
                                </div>
                                <div id="history-status" class="small text-muted" role="status" aria-live="polite">Choose a time range and load readings.</div>
                                <div id="history-warning" class="small text-warning mt-1" role="status"></div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">Temperature (°C) and pressure (PSI)</div>
                                    <div class="card-body"><canvas id="temperature-pressure-chart" height="180" width="100%" aria-label="Temperature and pressure readings"></canvas></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">Vibration (mm/s) and humidity (%)</div>
                                    <div class="card-body"><canvas id="vibration-humidity-chart" height="180" width="100%" aria-label="Vibration and humidity readings"></canvas></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">Energy (kWh) and power (kW)</div>
                                    <div class="card-body"><canvas id="energy-power-chart" height="180" width="100%" aria-label="Energy and power readings"></canvas></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card h-100">
                                    <div class="card-header">Latest sensor readings</div>
                                    <div class="table-responsive">
                                        <table class="table table-sm mb-0">
                                            <thead><tr><th>Time</th><th>Scenario</th><th>Temperature</th><th>Pressure</th><th>Vibration</th></tr></thead>
                                            <tbody id="reading-rows"><tr><td colspan="5" class="text-muted text-center">No readings yet.</td></tr></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

@if ($machines->isNotEmpty())
<script>
(() => {
    const machineSelect = document.getElementById('machine-select');
    const statusBadge = document.getElementById('simulation-status');
    const operatingStateBadge = document.getElementById('operating-state');
    const message = document.getElementById('simulation-message');
    const rows = document.getElementById('reading-rows');
    const csrf = document.querySelector('input[name="_token"]').value;
    const historyLoadButton = document.getElementById('history-load');
    const historyPlayButton = document.getElementById('history-play');
    const historyPauseButton = document.getElementById('history-pause');
    const historyStopButton = document.getElementById('history-stop');
    const historyPosition = document.getElementById('history-position');
    const historyStatus = document.getElementById('history-status');
    const historyWarning = document.getElementById('history-warning');
    const readings = [];
    let historicalReadings = [];
    let liveReadingsSnapshot = [];
    let playbackIndex = -1;
    let playbackTimer = null;
    let playbackMode = false;
    let playbackIsRunning = false;
    let status = 'stopped';

    const route = (action) => @json(route('user.simulation.index')) + '/' + machineSelect.value + '/' + action;
    const showMessage = (text, isError = false) => {
        message.textContent = text;
        message.className = `small mt-3 ${isError ? 'text-danger' : 'text-success'}`;
    };

    function drawChart(canvasId, series) {
        const canvas = document.getElementById(canvasId);
        const context = canvas.getContext('2d');
        const width = canvas.clientWidth;
        const height = canvas.clientHeight;
        const ratio = window.devicePixelRatio || 1;
        canvas.width = width * ratio;
        canvas.height = height * ratio;
        context.scale(ratio, ratio);
        context.clearRect(0, 0, width, height);
        context.font = '12px sans-serif';
        context.fillStyle = '#495057';
        context.strokeStyle = '#dee2e6';
        context.beginPath();
        context.moveTo(36, 12);
        context.lineTo(36, height - 24);
        context.lineTo(width - 8, height - 24);
        context.stroke();

        const values = series.flatMap(item => readings.map(reading => Number(reading.values?.[item.key])).filter(Number.isFinite));
        if (!values.length) {
            context.fillText('Waiting for sensor data', 48, 34);
            return;
        }

        const min = Math.min(...values);
        const max = Math.max(...values);
        const range = max - min || 1;
        series.forEach((item, seriesIndex) => {
            context.strokeStyle = item.color;
            context.lineWidth = 2;
            context.beginPath();
            let started = false;
            readings.forEach((reading, index) => {
                const value = Number(reading.values?.[item.key]);
                if (!Number.isFinite(value)) return;
                const x = 40 + (Math.max(1, width - 52) * index / Math.max(1, readings.length - 1));
                const y = height - 28 - ((value - min) / range * (height - 46));
                if (!started) {
                    context.moveTo(x, y);
                    started = true;
                } else {
                    context.lineTo(x, y);
                }
            });
            context.stroke();
            context.fillStyle = item.color;
            context.fillText(item.label, 48 + seriesIndex * 130, 16);
        });
    }

    function render() {
        const definitions = [
            ['temperature-pressure-chart', [{key: 'temperature', label: 'Temperature', color: '#dc3545'}, {key: 'pressure', label: 'Pressure', color: '#0d6efd'}]],
            ['vibration-humidity-chart', [{key: 'vibration', label: 'Vibration', color: '#6f42c1'}, {key: 'humidity', label: 'Humidity', color: '#198754'}]],
            ['energy-power-chart', [{key: 'energy', label: 'Energy', color: '#fd7e14'}, {key: 'power', label: 'Power', color: '#0dcaf0'}]],
        ];
        definitions.forEach(([id, series]) => drawChart(id, series));
        document.getElementById('reading-count').textContent = readings.length;
        rows.replaceChildren();

        if (!readings.length) {
            const row = rows.insertRow();
            const cell = row.insertCell();
            cell.colSpan = 5;
            cell.className = 'text-muted text-center';
            cell.textContent = 'No readings yet.';
            return;
        }

        readings.slice(-10).reverse().forEach(reading => {
            const value = reading.values || {};
            const time = reading.timestamp ? new Date(reading.timestamp).toLocaleTimeString() : '—';
            const row = rows.insertRow();
            [
                time,
                reading.scenario ?? 'external',
                `${value.temperature ?? '—'} °C`,
                `${value.pressure ?? '—'} PSI`,
                `${value.vibration ?? '—'} mm/s`,
            ].forEach(text => {
                row.insertCell().textContent = text;
            });
        });
    }

    function setStatus(nextStatus) {
        status = nextStatus;
        statusBadge.textContent = nextStatus.charAt(0).toUpperCase() + nextStatus.slice(1);
        statusBadge.className = `badge text-bg-${nextStatus === 'running' ? 'success' : nextStatus === 'paused' ? 'warning' : 'secondary'}`;
        machineSelect.selectedOptions[0].dataset.status = nextStatus;
        document.getElementById('running-count').textContent = Array.from(machineSelect.options)
            .filter(option => option.dataset.status === 'running').length;
    }

    function setOperatingState(nextState) {
        const label = nextState.replaceAll('_', ' ').replace(/\b\w/g, character => character.toUpperCase());
        operatingStateBadge.textContent = label;
        operatingStateBadge.className = `badge text-bg-${nextState === 'running' || nextState === 'ready' ? 'success' : nextState === 'fault' || nextState === 'emergency_stop' ? 'danger' : ['maintenance', 'paused', 'starting', 'stopping'].includes(nextState) ? 'warning' : 'secondary'}`;
        machineSelect.selectedOptions[0].dataset.operatingState = nextState;
        document.getElementById('operating-state-select').value = ['ready', 'maintenance', 'fault', 'emergency_stop'].includes(nextState) ? nextState : 'ready';
    }

    function renderPlaybackPosition(index) {
        playbackIndex = index;
        const start = Math.max(0, index - 59);
        readings.splice(0, readings.length, ...historicalReadings.slice(start, index + 1));
        historyPosition.value = index;
        const reading = historicalReadings[index];
        const time = reading?.timestamp ? new Date(reading.timestamp).toLocaleString() : '—';
        historyStatus.textContent = `Reading ${index + 1} of ${historicalReadings.length} · ${time}`;
        render();
    }

    function stopPlayback() {
        window.clearTimeout(playbackTimer);
        playbackTimer = null;
        playbackIsRunning = false;
        playbackMode = false;
        historicalReadings = [];
        playbackIndex = -1;
        historyPosition.disabled = true;
        historyPosition.max = 0;
        historyPosition.value = 0;
        historyPlayButton.disabled = true;
        historyPauseButton.disabled = true;
        historyStopButton.disabled = true;
        historyWarning.textContent = '';
        readings.splice(0, readings.length, ...liveReadingsSnapshot);
        liveReadingsSnapshot = [];
        render();
    }

    function playNextHistoricalReading() {
        if (!playbackIsRunning) return;
        const nextIndex = playbackIndex + 1;
        if (nextIndex >= historicalReadings.length) {
            playbackIsRunning = false;
            historyStatus.textContent = 'Playback complete.';
            return;
        }

        renderPlaybackPosition(nextIndex);
        historyPauseButton.disabled = false;

        if (nextIndex === historicalReadings.length - 1) {
            playbackIsRunning = false;
            historyPauseButton.disabled = true;
            historyStatus.textContent += ' · Playback complete.';
            return;
        }

        const currentTime = Date.parse(historicalReadings[nextIndex].timestamp);
        const nextTime = Date.parse(historicalReadings[nextIndex + 1].timestamp);
        const speed = Number(document.getElementById('history-speed').value);
        const delay = Number.isFinite(currentTime) && Number.isFinite(nextTime)
            ? Math.min(10000, Math.max(100, (nextTime - currentTime) / speed))
            : 1000 / speed;
        playbackTimer = window.setTimeout(playNextHistoricalReading, delay);
    }

    async function request(url, options = {}) {
        const response = await fetch(url, {
            ...options,
            headers: {'Accept': 'application/json', 'X-CSRF-TOKEN': csrf, ...(options.headers || {})},
        });
        const result = await response.json();
        if (!response.ok) throw new Error(result.message || 'The request could not be completed.');
        return result;
    }

    async function loadHistory() {
        const result = await request(route('data'));
        const simulation = result.simulation || {};
        setStatus(simulation.status || 'stopped');
        setOperatingState(simulation.operating_state || simulation.status || 'stopped');
        if (simulation.scenario) document.getElementById('scenario-select').value = simulation.scenario;
        if (simulation.speed) document.getElementById('speed-select').value = simulation.speed;
        const thresholds = simulation.thresholds || {};
        if (thresholds.temperature_max !== undefined) document.getElementById('temperature-threshold').value = thresholds.temperature_max;
        if (thresholds.pressure_min !== undefined) document.getElementById('pressure-threshold').value = thresholds.pressure_min;
        if (thresholds.humidity_max !== undefined) document.getElementById('humidity-threshold').value = thresholds.humidity_max;
        if (thresholds.vibration_max !== undefined) document.getElementById('vibration-threshold').value = thresholds.vibration_max;
        if (simulation.temperature_offset !== undefined) document.getElementById('temperature-offset').value = simulation.temperature_offset;
        readings.splice(0, readings.length, ...result.readings.map(reading => ({
            ...reading,
            values: reading.values || {},
        })).slice(-60));
        render();
    }

    document.querySelectorAll('[data-action]').forEach(button => button.addEventListener('click', async () => {
        if (!machineSelect.value) return;
        button.disabled = true;
        try {
            const action = button.dataset.action;
            const body = action === 'start'
                ? JSON.stringify({
                    scenario: document.getElementById('scenario-select').value,
                    speed: Number(document.getElementById('speed-select').value),
                    temperature_offset: Number(document.getElementById('temperature-offset').value),
                    thresholds: {
                        temperature_max: Number(document.getElementById('temperature-threshold').value),
                        pressure_min: Number(document.getElementById('pressure-threshold').value),
                        humidity_max: Number(document.getElementById('humidity-threshold').value),
                        vibration_max: Number(document.getElementById('vibration-threshold').value),
                    },
                })
                : undefined;
            const result = await request(route(action), {
                method: 'POST',
                headers: body ? {'Content-Type': 'application/json'} : {},
                body,
            });
            setStatus(result.status);
            setOperatingState(result.simulation?.operating_state || result.status);
            showMessage(`Simulation ${result.status}.`);
        } catch (error) {
            showMessage(error.message, true);
        } finally {
            button.disabled = false;
        }
    }));

    document.getElementById('set-operating-state').addEventListener('click', async event => {
        const button = event.currentTarget;
        button.disabled = true;
        try {
            const result = await request(route('operating-state'), {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({state: document.getElementById('operating-state-select').value}),
            });
            setStatus(result.status);
            setOperatingState(result.operating_state);
            showMessage(`Machine state updated to ${result.operating_state.replaceAll('_', ' ')}.`);
        } catch (error) {
            showMessage(error.message, true);
        } finally {
            button.disabled = false;
        }
    });

    machineSelect.addEventListener('change', () => {
        stopPlayback();
        historyStatus.className = 'small text-muted';
        historyStatus.textContent = 'Choose a time range and load readings.';
        loadHistory().catch(error => showMessage(error.message, true));
    });
    window.addEventListener('resize', render);
    loadHistory().catch(error => showMessage(error.message, true));

    historyLoadButton.addEventListener('click', async () => {
        historyLoadButton.disabled = true;
        window.clearTimeout(playbackTimer);
        playbackTimer = null;
        playbackIsRunning = false;
        if (!playbackMode) liveReadingsSnapshot = readings.slice();
        playbackMode = true;
        historyWarning.textContent = '';
        historyStatus.className = 'small text-muted';

        try {
            const params = new URLSearchParams();
            const from = document.getElementById('history-from').value;
            const to = document.getElementById('history-to').value;
            if (from) params.set('from', from);
            if (to) params.set('to', to);
            params.set('limit', '1000');

            const result = await request(`${route('history')}?${params.toString()}`);
            historicalReadings = result.readings.map(reading => ({
                ...reading,
                values: reading.values || {},
            }));
            playbackIndex = -1;
            historyPosition.min = 0;
            historyPosition.max = Math.max(0, historicalReadings.length - 1);
            historyPosition.value = 0;
            historyPosition.disabled = historicalReadings.length === 0;
            historyPlayButton.disabled = historicalReadings.length === 0;
            historyPauseButton.disabled = true;
            historyStopButton.disabled = historicalReadings.length === 0;
            historyStatus.textContent = historicalReadings.length
                ? `Loaded ${historicalReadings.length} historical readings.`
                : 'No readings found in this time range.';
            historyWarning.textContent = result.truncated
                ? 'Showing the first 1,000 readings. Narrow the time range to inspect later readings.'
                : '';

            if (historicalReadings.length) {
                readings.splice(0, readings.length);
                render();
            } else {
                playbackMode = false;
                readings.splice(0, readings.length, ...liveReadingsSnapshot);
                liveReadingsSnapshot = [];
                render();
            }
        } catch (error) {
            playbackMode = false;
            readings.splice(0, readings.length, ...liveReadingsSnapshot);
            liveReadingsSnapshot = [];
            render();
            historyStatus.textContent = error.message;
            historyStatus.className = 'small text-danger';
        } finally {
            historyLoadButton.disabled = false;
        }
    });

    historyPlayButton.addEventListener('click', () => {
        if (!historicalReadings.length) return;
        if (playbackIndex >= historicalReadings.length - 1) playbackIndex = -1;
        playbackIsRunning = true;
        historyPauseButton.disabled = false;
        playNextHistoricalReading();
    });

    historyPauseButton.addEventListener('click', () => {
        window.clearTimeout(playbackTimer);
        playbackTimer = null;
        playbackIsRunning = false;
        historyStatus.textContent += ' · Paused.';
    });

    historyStopButton.addEventListener('click', () => {
        stopPlayback();
        historyStatus.textContent = 'Playback stopped. Live readings restored.';
    });

    historyPosition.addEventListener('input', () => {
        window.clearTimeout(playbackTimer);
        playbackTimer = null;
        playbackIsRunning = false;
        if (historicalReadings.length) renderPlaybackPosition(Number(historyPosition.value));
    });

    window.setInterval(async () => {
        if (!machineSelect.value || playbackMode) return;
        try {
            const result = await request(route('data'));
            if (playbackMode) return;
            setStatus(result.simulation?.status || 'stopped');
            readings.splice(0, readings.length, ...result.readings.map(reading => ({
                ...reading,
                values: reading.values || {},
            })).slice(-60));
            render();
        } catch (error) {
            showMessage(error.message, true);
        }
    }, 2000);
})();
</script>
@endif

@include('user.include.footer')
