@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
Sensor Details
                        </span>

                        <div class="navbar-nav ms-auto ">
                          <a href="{{ route('admin.sensors.edit', $sensor) }}" class="btn btn-primary">Edit</a>
                           <a href="{{ route('admin.sensors.index') }}" class="btn themeBtn ms-2">Back</a>
                        </div>

                    </div>

                </nav>



<div class="main-content p-4">
  <div class="card bg-white p-3 border-0">





  @if (session('success'))

    <div class="alert alert-success">{{ session('success') }}</div>

  @endif



  <div class="bg-white p-3 border-0 rounded">

    <dl class="row mb-0">

      <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $sensor->id }}</dd>

      <dt class="col-sm-3">Device ID</dt><dd class="col-sm-9">{{ $sensor->device_id }}</dd>

      <dt class="col-sm-3">Type</dt><dd class="col-sm-9">{{ $sensor->sensor_type }}</dd>

      <dt class="col-sm-3">Machine</dt><dd class="col-sm-9">{{ optional($sensor->machine)->name }}</dd>

      <dt class="col-sm-3">Firmware</dt><dd class="col-sm-9">{{ $sensor->firmware_version }}</dd>

      <dt class="col-sm-3">Battery</dt><dd class="col-sm-9">{{ $sensor->battery_level }}%</dd>

      <dt class="col-sm-3">Last Seen</dt><dd class="col-sm-9">{{ optional($sensor->last_seen)->format('Y-m-d H:i') }}</dd>

      <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ $sensor->status }}</dd>

      <dt class="col-sm-3">Created</dt><dd class="col-sm-9">{{ optional($sensor->created_at)->toDayDateTimeString() }}</dd>

      <dt class="col-sm-3">Updated</dt><dd class="col-sm-9">{{ optional($sensor->updated_at)->toDayDateTimeString() }}</dd>

    </dl>

  </div>

</div>

</div>



@include('admin.include.footer')





