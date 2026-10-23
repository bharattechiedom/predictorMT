<?php

$page_title = "Add New Sensor";

?>

@include('user.include.header')



<div class="wrapper active">

    <div class="page-content">

        <div class="page-container p-3">

            <div class="card">

                <div class="card-header">

                    <h4 class="mb-0 text-white">Add New Sensor</h4>

                </div>

                <div class="">

                    <form method="POST" action="{{ route('user.sensors.store') }}" class="bg-white p-3 border rounded">

    @csrf

    <div class="row g-3">

      <div class="col-md-6">

        <label class="form-label">Device ID</label>

        <input type="text" name="device_id" class="form-control" value="{{ old('device_id') }}" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Sensor Type</label>

        <input type="text" name="sensor_type" class="form-control" value="{{ old('sensor_type') }}" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Machine</label>

        <select name="machine_id" class="form-select">

          <option value="">(Optional) Select Machine</option>

          @foreach($machines as $machine)

            <option value="{{ $machine->id }}">{{ $machine->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Firmware Version</label>

        <input type="text" name="firmware_version" class="form-control" value="{{ old('firmware_version') }}">

      </div>

      <div class="col-md-6">

        <label class="form-label">Battery Level (%)</label>

        <input type="number" name="battery_level" class="form-control" min="0" max="100" value="{{ old('battery_level') }}">

      </div>

      <div class="col-md-6">

        <label class="form-label">Last Seen</label>

        <input type="datetime-local" name="last_seen" class="form-control" value="{{ old('last_seen') }}">

      </div>

      <div class="col-md-6">

        <label class="form-label">Status</label>

        <select name="status" class="form-select" required>

          @foreach(['active','inactive','faulty','provisioning'] as $status)

            <option value="{{ $status }}" {{ old('status')===$status?'selected':'' }}>{{ $status }}</option>

          @endforeach

        </select>

      </div>

    </div>

    <div class="mt-3">

      <button type="submit" class="btn btn-primary">Create</button>

    </div>

  </form>

                </div>

            </div>

        </div>

    </div>

</div>



@include('user.include.footer')