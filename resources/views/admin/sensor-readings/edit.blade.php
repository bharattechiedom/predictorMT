@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
Edit Sensor Reading
                        </span>

                        <div class="navbar-nav ms-auto ">
                                <a href="{{ route('admin.sensor-readings.edit', $reading) }}" class="btn btn-primary">Edit</a>

          <a href="{{ route('admin.sensor-readings.index') }}" class="btn themeBtn">Back</a>

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



  <form method="POST" action="{{ route('admin.sensor-readings.update', $reading) }}" class="bg-white p-3 border-0 rounded">

    @csrf

    @method('PUT')

    <div class="row g-3">

      <div class="col-md-6">

        <label class="form-label">Sensor</label>

        <select name="sensor_id" class="form-select" required>

          @foreach($sensors as $sensor)

            <option value="{{ $sensor->id }}" {{ $reading->sensor_id==$sensor->id?'selected':'' }}>{{ $sensor->device_id }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Machine</label>

        <select name="machine_id" class="form-select" required>

          @foreach($machines as $machine)

            <option value="{{ $machine->id }}" {{ $reading->machine_id==$machine->id?'selected':'' }}>{{ $machine->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Timestamp</label>

        <input type="datetime-local" name="timestamp" class="form-control" value="{{ optional($reading->timestamp)->format('Y-m-d\TH:i') }}" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Value (float)</label>

        <input type="number" step="any" name="value_float" class="form-control" value="{{ $reading->value_float }}">

      </div>

      <div class="col-12">

        <label class="form-label">Payload (JSON)</label>

        <textarea name="payload" class="form-control" rows="4">{{ is_array($reading->payload) ? json_encode($reading->payload) : $reading->payload }}</textarea>

      </div>

    </div>

    <div class="mt-3">

      <button type="submit" class="btn btn-primary">Update</button>

    </div>

  </form>

</div>

</div>



@include('admin.include.footer')





