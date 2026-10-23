@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">

                           Add Sensor
                        </span>

                        <div class="navbar-nav ms-auto ">
                           <a href="{{ route('admin.sensors.index') }}" class="btn themeBtn">Back</a>
                        </div>

                    </div>

                </nav>



<div class="main-content p-4">
  <div class="card bg-white p-3 border-0">




  @if ($errors->any())

    <div class="alert alert-danger">

      <ul class="mb-0">

        @foreach ($errors->all() as $error)

          <li>{{ $error }}</li>

        @endforeach

      </ul>

    </div>

  @endif



  <form method="POST" action="{{ route('admin.sensors.store') }}" class="bg-white p-3 border-0 rounded">

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



@include('admin.include.footer')





