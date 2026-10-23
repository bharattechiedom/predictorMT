@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
                          Edit Alert
                        </span>

                        <div class="navbar-nav ms-auto ">
                          
        <a href="{{ route('admin.alerts.index') }}" class="btn themeBtn">Back</a>


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



  <form method="POST" action="{{ route('admin.alerts.update', $alert) }}" class="bg-white p-3 border-0 rounded">

    @csrf

    @method('PUT')

    <div class="row g-3">

      <div class="col-md-6">

        <label class="form-label">Company</label>

        <select name="company_id" class="form-select" required>

          @foreach($companies as $company)

            <option value="{{ $company->id }}" {{ $alert->company_id==$company->id?'selected':'' }}>{{ $company->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Machine</label>

        <select name="machine_id" class="form-select" required>

          @foreach($machines as $machine)

            <option value="{{ $machine->id }}" {{ $alert->machine_id==$machine->id?'selected':'' }}>{{ $machine->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Sensor (optional)</label>

        <select name="sensor_id" class="form-select">

          <option value="">None</option>

          @foreach($sensors as $sensor)

            <option value="{{ $sensor->id }}" {{ $alert->sensor_id==$sensor->id?'selected':'' }}>{{ $sensor->device_id }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Level</label>

        <select name="level" class="form-select" required>

          @foreach(['info','warning','critical'] as $level)

            <option value="{{ $level }}" {{ $alert->level === $level ? 'selected' : '' }}>{{ $level }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-12">

        <label class="form-label">Message</label>

        <input type="text" name="message" class="form-control" maxlength="500" value="{{ $alert->message }}" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Origin</label>

        <select name="origin" class="form-select" required>

          @foreach(['rule','prediction','manual','sensor'] as $origin)

            <option value="{{ $origin }}" {{ $alert->origin === $origin ? 'selected' : '' }}>{{ $origin }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-12">

        <label class="form-label">Payload (JSON)</label>

        <textarea name="payload" class="form-control" rows="3">{{ is_array($alert->payload) ? json_encode($alert->payload) : $alert->payload }}</textarea>

      </div>

      <div class="col-md-6">

        <label class="form-label">Acknowledged By</label>

        <select name="acknowledged_by" class="form-select">

          <option value="">None</option>

          @foreach($users as $user)

            <option value="{{ $user->id }}" {{ $alert->acknowledged_by==$user->id?'selected':'' }}>{{ $user->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Acknowledged At</label>

        <input type="datetime-local" name="acknowledged_at" class="form-control" value="{{ optional($alert->acknowledged_at)->format('Y-m-d\TH:i') }}">

      </div>

    </div>

    <div class="mt-3">

      <button type="submit" class="btn btn-primary">Update</button>

    </div>

  </form>

</div>

</div>



@include('admin.include.footer')





