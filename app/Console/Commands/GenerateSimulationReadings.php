<?php

namespace App\Console\Commands;

use App\Models\Machine;
use App\Services\MachineSimulationService;
use Illuminate\Console\Command;

class GenerateSimulationReadings extends Command
{
    protected $signature = 'simulations:tick';

    protected $description = 'Generate a sensor reading for each running machine simulation';

    public function handle(MachineSimulationService $simulator): int
    {
        $generated = 0;

        Machine::query()
            ->where(function ($query) {
                $query->where('metadata->simulation->status', 'running')
                    ->orWhere('metadata->simulation->operating_state', 'stopping');
            })
            ->orderBy('id')
            ->chunkById(100, function ($machines) use ($simulator, &$generated) {
                $machines->each(function (Machine $machine) use ($simulator, &$generated) {
                    if (data_get($machine->metadata, 'simulation.operating_state') === 'stopping') {
                        $simulator->completeStopping($machine);
                    } elseif ($simulator->tick($machine)) {
                        $generated++;
                    }
                });
            });

        $this->info("Generated {$generated} simulation reading(s).");

        return self::SUCCESS;
    }
}
