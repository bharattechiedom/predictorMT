<?php
$page_title = "Alert Details";
?>
@include('user.include.header')

<div class="wrapper active">
  <div class="page-content">
    <div class="page-container p-3">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="mb-0">Alert #{{ $alert->id }}</h4>
          <div>
            @if(!$alert->acknowledged_at)
            <form method="POST" action="{{ route('user.alerts.acknowledge', $alert) }}" style="display:inline;">
              @csrf
              <button class="btn btn-sm btn-success">Acknowledge</button>
            </form>
            @endif
            <a href="{{ route('user.alerts.index') }}" class="btn btn-sm btn-secondary">Back</a>
          </div>
        </div>
        <div class="card-body">
          <h5>{{ $alert->message }}</h5>
          <p class="text-muted">Origin: {{ ucfirst($alert->origin) }} • Level: <span class="badge bg-{{ $alert->level=='critical'?'danger':'secondary' }}">{{ $alert->level }}</span></p>
          <p><strong>Machine:</strong> @if($alert->machine) <a href="{{ route('user.machines.show', $alert->machine) }}">{{ $alert->machine->name }}</a> @else N/A @endif</p>
          <p><strong>Sensor:</strong> @if($alert->sensor) <a href="{{ route('user.sensors.show', $alert->sensor) }}">{{ $alert->sensor->device_id }}</a> @else N/A @endif</p>
          <hr>
          <p><strong>Payload</strong></p>
          <pre>{{ json_encode($alert->payload, JSON_PRETTY_PRINT) }}</pre>
          <hr>
          <p class="text-muted small">Created: {{ $alert->created_at->format('M d, Y H:i:s') }}</p>
          @if($alert->acknowledged_at)
          <p class="text-muted small">Acknowledged: {{ $alert->acknowledged_at->format('M d, Y H:i:s') }} by {{ $alert->acknowledgedBy?->name }}</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@include('user.include.footer')
