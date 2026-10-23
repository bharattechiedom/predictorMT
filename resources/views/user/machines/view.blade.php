<?php

$page_title = "Detail View";

?>



@include('user.include.header')



<div class="page-content p-3 bg-white">
  <div class="card">

  <div class="card-header d-flex justify-content-between align-items-center py-2">

    <h4 class="header-title mb-0 text-white">Detail View</h4>

    <a href="{{ route('user.machines.index') }}" class="btn btn-secondary">← Back to List</a>

  </div>



  <div class="card-body bg-white">

    @if (session('success'))

      <div class="alert alert-success">{{ session('success') }}</div>

    @endif

    <p>Name: {{ $machine->name }}</p>

    <p><strong>Type:</strong> {{ $machine->machine_type }}</p>

    <p><strong>Serial Number:</strong> {{ $machine->serial_number }}</p>

    <p><strong>Location:</strong> {{ $machine->location }}</p>

    <p><strong>Status:</strong> {{ $machine->status }}</p>

    <p><strong>Installed At:</strong> {{ optional($machine->installed_at)->format('Y-m-d') }}</p>

  </div>
</div>
</div>

@include('user.include.footer')