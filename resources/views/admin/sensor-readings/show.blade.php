@include('admin.include.header')




<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
Sensor Reading Details
                        </span>

                        <div class="navbar-nav ms-auto ">
                                <a href="{{ route('admin.sensor-readings.edit', $reading) }}" class="btn btn-primary">Edit</a>

      <a href="{{ route('admin.sensor-readings.index') }}" class="btn themeBtn ms-2">Back</a>

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

      <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $reading->id }}</dd>

      <dt class="col-sm-3">Timestamp</dt><dd class="col-sm-9">{{ optional($reading->timestamp)->format('Y-m-d H:i') }}</dd>

      <dt class="col-sm-3">Sensor</dt><dd class="col-sm-9">{{ optional($reading->sensor)->device_id }}</dd>

      <dt class="col-sm-3">Machine</dt><dd class="col-sm-9">{{ optional($reading->machine)->name }}</dd>

      <dt class="col-sm-3">Value</dt><dd class="col-sm-9">{{ $reading->value_float }}</dd>

      <dt class="col-sm-3">Payload</dt><dd class="col-sm-9"><pre class="mb-0" style="white-space:pre-wrap">{{ is_array($reading->payload) ? json_encode($reading->payload, JSON_PRETTY_PRINT) : $reading->payload }}</pre></dd>

    </dl>

  </div>

</div>

</div>



@include('admin.include.footer')





