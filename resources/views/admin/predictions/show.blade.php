@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
Prediction Details
                        </span>

                        <div class="navbar-nav ms-auto ">

                        <a href="{{ route('admin.predictions.edit', $prediction) }}" class="btn btn-primary">Edit</a>

      <a href="{{ route('admin.predictions.index') }}" class="btn themeBtn">Back</a>


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

      <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $prediction->id }}</dd>

      <dt class="col-sm-3">Machine</dt><dd class="col-sm-9">{{ optional($prediction->machine)->name }}</dd>

      <dt class="col-sm-3">Sensor</dt><dd class="col-sm-9">{{ optional($prediction->sensor)->device_id }}</dd>

      <dt class="col-sm-3">Predicted At</dt><dd class="col-sm-9">{{ optional($prediction->predicted_at)->format('Y-m-d H:i') }}</dd>

      <dt class="col-sm-3">Predicted Failure At</dt><dd class="col-sm-9">{{ optional($prediction->predicted_failure_at)->format('Y-m-d H:i') }}</dd>

      <dt class="col-sm-3">Probability</dt><dd class="col-sm-9">{{ $prediction->probability }}</dd>

      <dt class="col-sm-3">Component</dt><dd class="col-sm-9">{{ $prediction->component }}</dd>

      <dt class="col-sm-3">Model Version</dt><dd class="col-sm-9">{{ $prediction->model_version }}</dd>

      <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ $prediction->status }}</dd>

      <dt class="col-sm-3">Explanation</dt><dd class="col-sm-9"><pre class="mb-0" style="white-space:pre-wrap">{{ is_array($prediction->explanation) ? json_encode($prediction->explanation, JSON_PRETTY_PRINT) : $prediction->explanation }}</pre></dd>

    </dl>

  </div>

</div>
</div>



@include('admin.include.footer')





