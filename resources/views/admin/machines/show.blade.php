@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">

                            <i class="fas fa-building me-2"></i>

                            Machine Details

                        </span>

                        <div class="navbar-nav ms-auto ">
                         <a href="{{ route('admin.machines.edit', $machine) }}" class="btn btn-primary">Edit</a>

      <a href="{{ route('admin.machines.index') }}" class="btn themeBtn ms-2">Back</a>
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

      <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $machine->id }}</dd>

      <dt class="col-sm-3">Company</dt><dd class="col-sm-9">{{ optional($machine->company)->name }}</dd>

      <dt class="col-sm-3">Name</dt><dd class="col-sm-9">{{ $machine->name }}</dd>

      <dt class="col-sm-3">Type</dt><dd class="col-sm-9">{{ $machine->machine_type }}</dd>

      <dt class="col-sm-3">Serial</dt><dd class="col-sm-9">{{ $machine->serial_number }}</dd>

      <dt class="col-sm-3">Location</dt><dd class="col-sm-9">{{ $machine->location }}</dd>

      <dt class="col-sm-3">Installed At</dt><dd class="col-sm-9">{{ optional($machine->installed_at)->format('Y-m-d') }}</dd>

      <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ $machine->status }}</dd>

      <dt class="col-sm-3">Created</dt><dd class="col-sm-9">{{ optional($machine->created_at)->toDayDateTimeString() }}</dd>

      <dt class="col-sm-3">Updated</dt><dd class="col-sm-9">{{ optional($machine->updated_at)->toDayDateTimeString() }}</dd>

    </dl>

  </div>

</div>

</div>



@include('admin.include.footer')





