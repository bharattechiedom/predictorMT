<?php

$page_title = "Maintenance Task Details";

?>

@include('user.include.header')



<div class="wrapper active">

    <div class="page-content">

        <div class="page-container p-3">

            <div class="row g-3">

                <!-- Task Info -->

                <div class="col-lg-8">

                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h4 class="mb-0 text-white">Task #{{ $task->id }} Details</h4>

                            <div class="btn-group">

                                <a href="{{ route('user.maintenance-tasks.edit', $task) }}" class="btn btn-primary btn-sm">

                                    <i class="bi bi-pencil me-2"></i> Edit

                                </a>

                            </div>

                        </div>

                        <div class="card-body bg-white">

                            <div class="row">

                                <div class="col-md-6">

                                    <h6 class="mb-2">Machine</h6>

                                    <p>

                                        <a href="{{ route('user.machines.show', $task->machine) }}">

                                            {{ $task->machine->name }}

                                        </a>

                                        <br>

                                        <small class="text-muted">{{ $task->machine->machine_type }}</small>

                                    </p>



                                    <h6 class="mb-2">Created By</h6>

                                    <p>{{ $task->createdBy->name }}</p>



                                    <h6 class="mb-2">Assigned To</h6>

                                    <p>{{ $task->assignedTo ? $task->assignedTo->name : 'Unassigned' }}</p>

                                </div>



                                <div class="col-md-6">

                                    <h6 class="mb-2">Status</h6>

                                    <p>

                                        @php

                                            $statusClass = [

                                                'scheduled' => 'primary',

                                                'in_progress' => 'warning',

                                                'completed' => 'success',

                                                'cancelled' => 'danger'

                                            ][$task->status];

                                        @endphp

                                        <span class="badge bg-{{ $statusClass }}">

                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}

                                        </span>

                                    </p>



                                    <h6 class="mb-2">Scheduled For</h6>

                                    <p>

                                        {{ $task->scheduled_at->format('M d, Y H:i') }}

                                        <br>

                                        <small class="text-muted">({{ $task->scheduled_at->diffForHumans() }})</small>

                                    </p>



                                    @if($task->completed_at)

                                    <h6 class="mb-2">Completed On</h6>

                                    <p>

                                        {{ $task->completed_at->format('M d, Y H:i') }}

                                        <br>

                                        <small class="text-muted">({{ $task->completed_at->diffForHumans() }})</small>

                                    </p>

                                    @endif

                                </div>



                                <div class="col-12">

                                    <h6 class="mb-2">Notes</h6>

                                    <p class="mb-0">{{ $task->notes ?: 'No notes provided.' }}</p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- Cost and Parts -->

                <div class="col-lg-4">

                    <div class="card">

                        <div class="card-header">

                            <h5 class="mb-0 text-white">Cost Details</h5>

                        </div>

                        <div class="card-body bg-white">

                            <h6 class="mb-2">Estimated Cost</h6>

                            <p class="h4 mb-4">${{ number_format($task->cost_estimate, 2) }}</p>



                            @if($task->parts_required)

                            <h6 class="mb-3">Required Parts</h6>

                            <div class="table-responsive">

                                <table class="table table-sm">

                                    <thead>

                                        <tr>

                                            <th>Part</th>

                                            <th>Qty</th>

                                            <th>Cost</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @php

                                            $parts = json_decode($task->parts_required, true);

                                        @endphp

                                        @foreach($parts as $part)

                                        <tr>

                                            <td>{{ $part['name'] }}</td>

                                            <td>{{ $part['quantity'] }}</td>

                                            <td>${{ number_format($part['cost'], 2) }}</td>

                                        </tr>

                                        @endforeach

                                    </tbody>

                                    <tfoot>

                                        <tr>

                                            <th colspan="2">Total Parts Cost</th>

                                            <th>

                                                ${{ number_format(array_sum(array_map(function($part) {

                                                    return $part['cost'] * $part['quantity'];

                                                }, $parts)), 2) }}

                                            </th>

                                        </tr>

                                    </tfoot>

                                </table>

                            </div>

                            @else

                            <p class="text-muted">No parts specified</p>

                            @endif

                        </div>

                    </div>

                </div>



                <!-- Actions -->

                <div class="col-12">

                    <div class="cardBtn">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">

                                <a href="{{ route('user.maintenance-tasks.index') }}" class="btn btn-secondary">

                                    <i class="bi bi-arrow-left"></i> Back to List

                                </a>

                                

                                <div class="btn-group gap-3">

                                    @if($task->status === 'scheduled')

                                    <form action="{{ route('user.maintenance-tasks.update', $task) }}" method="POST" style="display: inline;">

                                        @csrf

                                        @method('PUT')

                                        <input type="hidden" name="status" value="in_progress">

                                        <button type="submit" class="btn btn-warning">

                                            <i class="bi bi-play"></i> Start Task

                                        </button>

                                    </form>

                                    @endif



                                    @if($task->status === 'in_progress')

                                    <form action="{{ route('user.maintenance-tasks.update', $task) }}" method="POST" style="display: inline;">

                                        @csrf

                                        @method('PUT')

                                        <input type="hidden" name="status" value="completed">

                                        <input type="hidden" name="completed_at" value="{{ now()->format('Y-m-d H:i:s') }}">

                                        <button type="submit" class="btn btn-success">

                                            <i class="bi bi-check2"></i> Mark Complete

                                        </button>

                                    </form>

                                    @endif



                                    @if(in_array($task->status, ['scheduled', 'in_progress']))

                                    <form action="{{ route('user.maintenance-tasks.update', $task) }}" 

                                          method="POST" 

                                          onsubmit="return confirm('Are you sure you want to cancel this task?');"

                                          style="display: inline;">

                                        @csrf

                                        @method('PUT')

                                        <input type="hidden" name="status" value="cancelled">

                                        <button type="submit" class="btn btn-danger">

                                            <i class="bi bi-x"></i> Cancel Task

                                        </button>

                                    </form>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



@include('user.include.footer')