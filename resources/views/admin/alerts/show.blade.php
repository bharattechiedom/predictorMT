@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
                          Alert Details
                        </span>

                        <div class="navbar-nav ms-auto ">
                          
        
      <a href="{{ route('admin.alerts.edit', $alert) }}" class="btn btn-primary">Edit</a>

      <a href="{{ route('admin.alerts.index') }}" class="btn themeBtn ms-2">Back</a>|


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

      <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $alert->id }}</dd>

      <dt class="col-sm-3">Company</dt><dd class="col-sm-9">{{ optional($alert->company)->name }}</dd>

      <dt class="col-sm-3">Machine</dt><dd class="col-sm-9">{{ optional($alert->machine)->name }}</dd>

      <dt class="col-sm-3">Sensor</dt><dd class="col-sm-9">{{ optional($alert->sensor)->device_id }}</dd>

      <dt class="col-sm-3">Level</dt><dd class="col-sm-9">{{ $alert->level }}</dd>

      <dt class="col-sm-3">Origin</dt><dd class="col-sm-9">{{ $alert->origin }}</dd>

      <dt class="col-sm-3">Message</dt><dd class="col-sm-9">{{ $alert->message }}</dd>

      <dt class="col-sm-3">Payload</dt><dd class="col-sm-9"><pre class="mb-0" style="white-space:pre-wrap">{{ is_array($alert->payload) ? json_encode($alert->payload, JSON_PRETTY_PRINT) : $alert->payload }}</pre></dd>

      <dt class="col-sm-3">Acknowledged By</dt><dd class="col-sm-9">{{ optional($alert->acknowledgedBy)->name ?? $alert->acknowledged_by }}</dd>

      <dt class="col-sm-3">Acknowledged At</dt><dd class="col-sm-9">{{ optional($alert->acknowledged_at)->format('Y-m-d H:i') }}</dd>

    </dl>

  </div>

</div>

</div>



@include('admin.include.footer')





