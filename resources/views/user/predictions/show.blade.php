<?php
$page_title = "Prediction Details";
?>
@include('user.include.header')

<div class="wrapper active">
    <div class="page-content">
        <div class="page-container p-3">
            <div class="row g-3">
                <!-- Prediction Info -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Prediction Details</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th width="30%">ID</th>
                                    <td>{{ $prediction->id }}</td>
                                </tr>
                                <tr>
                                    <th>Machine</th>
                                    <td>
                                        <a href="{{ route('user.machines.show', $prediction->machine) }}">
                                            {{ $prediction->machine->name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Predicted At</th>
                                    <td>{{ $prediction->predicted_at->format('M d, Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Expected Failure</th>
                                    <td>
                                        @if($prediction->predicted_failure_at)
                                            {{ $prediction->predicted_failure_at->format('M d, Y H:i:s') }}
                                            <br>
                                            <small class="text-muted">
                                                ({{ $prediction->predicted_failure_at->diffForHumans() }})
                                            </small>
                                        @else
                                            Not specified
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Component</th>
                                    <td>{{ $prediction->component ?: 'Not specified' }}</td>
                                </tr>
                                <tr>
                                    <th>Probability</th>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-{{ $prediction->probability > 0.7 ? 'danger' : ($prediction->probability > 0.4 ? 'warning' : 'success') }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $prediction->probability * 100 }}%">
                                                {{ number_format($prediction->probability * 100, 1) }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @php
                                            $statusClass = [
                                                'open' => 'danger',
                                                'acknowledged' => 'warning',
                                                'converted' => 'info',
                                                'resolved' => 'success'
                                            ][$prediction->status];
                                        @endphp
                                        <span class="badge bg-{{ $statusClass }}">{{ ucfirst($prediction->status) }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ML Explanation -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-cpu me-2"></i>ML Model Explanation</h5>
                        </div>
                        <div class="card-body">
                            @if($prediction->explanation)
                                @php
                                    $explanation = json_decode($prediction->explanation, true);
                                @endphp
                                <div class="mb-3">
                                    <h6>Model Version: {{ $prediction->model_version }}</h6>
                                </div>
                                
                                @if(isset($explanation['features']))
                                    <h6 class="mb-3">Feature Importance:</h6>
                                    @foreach($explanation['features'] as $feature => $importance)
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span>{{ ucfirst(str_replace('_', ' ', $feature)) }}</span>
                                                <span>{{ number_format($importance * 100, 1) }}%</span>
                                            </div>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-info" 
                                                     role="progressbar" 
                                                     style="width: {{ $importance * 100 }}%">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                
                                @if(isset($explanation['anomalies']))
                                    <h6 class="mt-4 mb-3">Detected Anomalies:</h6>
                                    <ul class="list-unstyled">
                                        @foreach($explanation['anomalies'] as $anomaly)
                                            <li class="mb-2">
                                                <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                                                {{ $anomaly }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @else
                                <p class="text-muted mb-0">No detailed explanation available for this prediction.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-tools me-2"></i>Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex gap-2">
                                @if($prediction->status === 'open')
                                    <form action="{{ route('user.predictions.acknowledge', $prediction) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">
                                            <i class="bi bi-check-circle me-2"></i>Acknowledge
                                        </button>
                                    </form>
                                @endif

                                @if(in_array($prediction->status, ['open', 'acknowledged']))
                                    <button type="button" 
                                            class="btn btn-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#convertModal">
                                        <i class="bi bi-tools me-2"></i>Convert to Task
                                    </button>

                                    <form action="{{ route('user.predictions.resolve', $prediction) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to mark this prediction as resolved?');">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-check2-all me-2"></i>Mark as Resolved
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('user.predictions.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Convert to Task Modal -->
            @if(in_array($prediction->status, ['open', 'acknowledged']))
            <div class="modal fade" id="convertModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('user.predictions.convert', $prediction) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Convert to Maintenance Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Schedule Date</label>
                                    <input type="datetime-local" name="scheduled_at" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Assign To</label>
                                    <select name="assigned_to" class="form-select">
                                        <option value="">Select Technician</option>
                                        @foreach($technicians as $tech)
                                        <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Notes</label>
                                    <textarea name="notes" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Create Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@include('user.include.footer')