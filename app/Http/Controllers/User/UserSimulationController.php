<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use App\Models\SensorReading;
use App\Services\MachineSimulationService;
use App\Services\SensorDataGenerator;
use App\Services\SystemSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserSimulationController extends Controller
{
    public function index(SystemSettings $systemSettings)
    {
        $machines = Auth::user()->company_id
            ? Machine::where('company_id', Auth::user()->company_id)
                ->withCount('sensors')
                ->orderBy('name')
                ->get()
            : collect();

        return view('user.simulation.index', [
            'machines' => $machines,
            'scenarios' => SensorDataGenerator::SCENARIOS,
            'simulationDefaults' => $systemSettings->simulationDefaults(),
            'defaultThresholds' => $systemSettings->simulationThresholds(),
        ]);
    }

    public function start(
        Request $request,
        int $machine,
        MachineSimulationService $simulator,
        SystemSettings $systemSettings
    ): JsonResponse {
        $validated = $request->validate([
            'scenario' => ['sometimes', 'required', 'string', 'in:'.implode(',', array_keys(SensorDataGenerator::SCENARIOS))],
            'speed' => ['sometimes', 'required', 'integer', 'in:1,2,5,10,20'],
            'thresholds.temperature_max' => ['required', 'numeric', 'between:30,200'],
            'thresholds.pressure_min' => ['required', 'numeric', 'between:0,500'],
            'thresholds.humidity_max' => ['required', 'numeric', 'between:0,100'],
            'thresholds.vibration_max' => ['required', 'numeric', 'between:0,100'],
            'temperature_offset' => ['nullable', 'numeric', 'between:-10,10'],
        ]);
        $defaults = $systemSettings->simulationDefaults();

        try {
            $state = $simulator->start(
                $this->machineForCurrentUser($machine),
                $validated['scenario'] ?? $defaults['scenario'],
                (int) ($validated['speed'] ?? $defaults['speed']),
                Auth::id(),
                [
                    'thresholds' => $validated['thresholds'],
                    'temperature_offset' => $validated['temperature_offset'] ?? 0,
                ]
            );
        } catch (\DomainException $exception) {
            return response()->json(['message' => $exception->getMessage()], 409);
        }

        return response()->json(['status' => 'running', 'simulation' => $state]);
    }

    public function pause(int $machine, MachineSimulationService $simulator): JsonResponse
    {
        $state = $simulator->pause($this->machineForCurrentUser($machine));

        return response()->json(['status' => 'paused', 'simulation' => $state]);
    }

    public function stop(int $machine, MachineSimulationService $simulator): JsonResponse
    {
        $state = $simulator->stop($this->machineForCurrentUser($machine));

        return response()->json(['status' => 'stopped', 'simulation' => $state]);
    }

    public function operatingState(Request $request, int $machine, MachineSimulationService $simulator): JsonResponse
    {
        $validated = $request->validate([
            'state' => ['required', 'string', 'in:ready,maintenance,fault,emergency_stop'],
        ]);
        $state = $simulator->setOperatingState(
            $this->machineForCurrentUser($machine),
            $validated['state']
        );

        return response()->json([
            'status' => $state['status'],
            'operating_state' => $state['operating_state'],
            'simulation' => $state,
        ]);
    }

    public function tick(int $machine, MachineSimulationService $simulator): JsonResponse
    {
        $reading = $simulator->tick($this->machineForCurrentUser($machine));

        if (! $reading) {
            return response()->json(['message' => 'The simulation is not running.'], 409);
        }

        return response()->json($this->readingResponse($reading));
    }

    public function data(int $machine): JsonResponse
    {
        $machine = $this->machineForCurrentUser($machine);
        $readings = SensorReading::where('machine_id', $machine->id)
            ->whereNotNull('payload')
            ->latest('timestamp')
            ->limit(60)
            ->get()
            ->reverse()
            ->values();

        return response()->json([
            'machine' => ['id' => $machine->id, 'name' => $machine->name],
            'simulation' => data_get($machine->metadata, 'simulation', ['status' => 'stopped']),
            'readings' => $readings->map(fn (SensorReading $reading) => $this->readingResponse($reading)),
        ]);
    }

    public function history(Request $request, int $machine): JsonResponse
    {
        $validated = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
            'limit' => ['sometimes', 'integer', 'between:1,1000'],
        ]);
        $machine = $this->machineForCurrentUser($machine);
        $limit = (int) ($validated['limit'] ?? 500);
        $query = SensorReading::query()
            ->where('machine_id', $machine->id)
            ->whereNotNull('payload');

        if (! empty($validated['from'])) {
            $query->where('timestamp', '>=', Carbon::parse($validated['from'])->toDateTimeString());
        }

        if (! empty($validated['to'])) {
            $to = Carbon::parse($validated['to']);
            $to = substr_count($validated['to'], ':') === 1 ? $to->endOfMinute() : $to;
            if (! str_contains($validated['to'], ':')) {
                $to->endOfDay();
            }
            $query->where('timestamp', '<=', $to->toDateTimeString());
        }

        $readings = $query
            ->orderBy('timestamp')
            ->orderBy('id')
            ->limit($limit + 1)
            ->get();
        $truncated = $readings->count() > $limit;
        $readings = $readings->take($limit)->values();

        return response()->json([
            'machine' => ['id' => $machine->id, 'name' => $machine->name],
            'count' => $readings->count(),
            'truncated' => $truncated,
            'readings' => $readings->map(fn (SensorReading $reading) => $this->readingResponse($reading)),
        ]);
    }

    private function machineForCurrentUser(int $id): Machine
    {
        return Machine::where('company_id', Auth::user()->company_id)->findOrFail($id);
    }

    private function readingResponse(SensorReading $reading): array
    {
        $payload = $reading->payload ?? [];

        return [
            'id' => $reading->id,
            'timestamp' => $reading->timestamp?->toIso8601String(),
            'scenario' => $payload['scenario'] ?? 'external',
            'values' => $payload['values'] ?? [],
        ];
    }
}
