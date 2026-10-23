<?php

$page_title = "Edit Record";

?>



@include('user.include.header')



<div class="page-content p-3 bg-white">
  <div class="card">

  <div class="card-header d-flex justify-content-between align-items-center py-2">

    <h4 class="header-title mb-0 text-white">Edit Machine - {{ $machine->name }}</h4>

    <a href="{{ route('user.machines.index') }}" class="btn btn-secondary">← Back to List</a>

  </div>



  <div class="card-body bg-white">

    @if ($errors->any())

      <div class="alert alert-danger">

        <ul class="mb-0">

          @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

          @endforeach

        </ul>

      </div>

    @endif

    <form method="POST" action="{{ route('user.machines.update', $machine) }}" class="bg-white p-3">

    @csrf

    @method('PUT')

    <div class="row g-3">

      

      <div class="col-md-6">

        <label class="form-label">Name<span>* </span></label>

        <input type="text" name="name" class="form-control" value="{{ old('name', $machine->name) }}" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Type<span>* </span></label>

        <input type="text" name="machine_type" class="form-control" value="{{ old('machine_type', $machine->machine_type) }}" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Serial Number<span>* </span></label>

        <input type="text" name="serial_number" class="form-control" value="{{ old('serial_number', $machine->serial_number) }}" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Location<span>* </span></label>

        <input type="text" name="location" class="form-control" value="{{ old('location', $machine->location) }}" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Installed At<span>* </span></label>

        <input type="date" name="installed_at" class="form-control" value="{{ old('installed_at', optional($machine->installed_at)->format('Y-m-d')) }}" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Status<span>* </span></label>

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

</div>

@include('user.include.footer')