@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">

<nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">

                            <i class="fas fa-building me-2"></i>

                            Edit Machine

                        </span>

                        <div class="navbar-nav ms-auto">
                          <a href="{{ route('admin.machines.index') }}" class="btn themeBtn">Back</a>
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



  <form method="POST" action="{{ route('admin.machines.update', $machine) }}" class="bg-white p-3 border-0">

    @csrf

    @method('PUT')

    <div class="row g-3">

      <div class="col-md-6">

        <label class="form-label">Company</label>

        <select name="company_id" class="form-select" required>

          @foreach($companies as $company)

            <option value="{{ $company->id }}" {{ $machine->company_id==$company->id?'selected':'' }}>{{ $company->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Name</label>

        <input type="text" name="name" class="form-control" value="{{ old('name', $machine->name) }}" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Type</label>

        <input type="text" name="machine_type" class="form-control" value="{{ old('machine_type', $machine->machine_type) }}">

      </div>

      <div class="col-md-6">

        <label class="form-label">Serial Number</label>

        <input type="text" name="serial_number" class="form-control" value="{{ old('serial_number', $machine->serial_number) }}">

      </div>

      <div class="col-md-6">

        <label class="form-label">Location</label>

        <input type="text" name="location" class="form-control" value="{{ old('location', $machine->location) }}">

      </div>

      <div class="col-md-6">

        <label class="form-label">Installed At</label>

        <input type="date" name="installed_at" class="form-control" value="{{ old('installed_at', optional($machine->installed_at)->format('Y-m-d')) }}">

      </div>

      <div class="col-md-6">

        <label class="form-label">Status</label>

        <select name="status" class="form-select" required>

          @foreach(['healthy','at_risk','critical','offline'] as $status)

            <option value="{{ $status }}" {{ $machine->status === $status ? 'selected' : '' }}>{{ $status }}</option>

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





