@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
                          Edit Prediction
                        </span>

                        <div class="navbar-nav ms-auto ">
      <a href="{{ route('admin.predictions.index') }}" class="btn themeBtn">Back</a>


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



  <form method="POST" action="{{ route('admin.predictions.update', $prediction) }}" class="bg-white p-3 border-0 rounded">

    @csrf

    @method('PUT')

    <div class="row g-3">

      <div class="col-md-6">

        <label class="form-label">Machine</label>

        <select name="machine_id" class="form-select" required>

          @foreach($machines as $machine)

            <option value="{{ $machine->id }}" {{ $prediction->machine_id==$machine->id?'selected':'' }}>{{ $machine->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Sensor (optional)</label>

        <select name="sensor_id" class="form-select">

          <option value="">None</option>

          @foreach($sensors as $sensor)

            <option value="{{ $sensor->id }}" {{ $prediction->sensor_id==$sensor->id?'selected':'' }}>{{ $sensor->device_id }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Predicted At</label>

        <input type="datetime-local" name="predicted_at" class="form-control" value="{{ optional($prediction->predicted_at)->format('Y-m-d\TH:i') }}" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Predicted Failure At</label>

        <input type="datetime-local" name="predicted_failure_at" class="form-control" value="{{ optional($prediction->predicted_failure_at)->format('Y-m-d\TH:i') }}">

      </div>

      <div class="col-md-6">

        <label class="form-label">Probability (0-1)</label>

        <input type="number" step="0.0001" min="0" max="1" name="probability" class="form-control" value="{{ $prediction->probability }}">

      </div>

      <div class="col-md-6">

        <label class="form-label">Component</label>

        <input type="text" name="component" class="form-control" value="{{ $prediction->component }}">

      </div>

      <div class="col-md-6">

        <label class="form-label">Model Version</label>

        <input type="text" name="model_version" class="form-control" value="{{ $prediction->model_version }}" required>

      </div>

      <div class="col-12">

        <label class="form-label">Explanation (JSON)</label>

        <textarea name="explanation" class="form-control" rows="4">{{ is_array($prediction->explanation) ? json_encode($prediction->explanation) : $prediction->explanation }}</textarea>

      </div>

      <div class="col-md-6">

        <label class="form-label">Status</label>

        <select name="status" class="form-select" required>

          @foreach(['open','acknowledged','converted','resolved'] as $status)

            <option value="{{ $status }}" {{ $prediction->status === $status ? 'selected' : '' }}>{{ $status }}</option>

          @endforeach

        </select>

      </div>

    </div>

    <div class="mt-3">

      <button type="submit" class="btn btn-primary">Update</button>

    </div>

  </form>

</div>

</div>



@include('admin.include.footer')





