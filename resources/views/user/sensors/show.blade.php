<?php

$page_title = "Sensor Details";

?>

@include('user.include.header')



<div class="wrapper active">

    <div class="page-content">

        <div class="page-container p-3">


                <!-- Sensor Info -->
 <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center py-2">

                    <h4 class="mb-0 text-white">Sensor Details</h4>
                          <a href="{{ route('user.sensors.index') }}" class="btn btn-secondary">Back</a>

                </div>

                <div class="card-body bg-white">


 


  @if (session('success'))

    <div class="alert alert-success">{{ session('success') }}</div>

  @endif



  <div class="bg-white p-3">

    <dl class="row mb-0">

      <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $sensor->id }}</dd>

      <dt class="col-sm-3">Device ID</dt><dd class="col-sm-9">{{ $sensor->device_id }}</dd>

      <dt class="col-sm-3">Type</dt><dd class="col-sm-9">{{ $sensor->sensor_type }}</dd>

      <dt class="col-sm-3">Machine</dt><dd class="col-sm-9">{{ optional($sensor->machine)->name }}</dd>

      <dt class="col-sm-3">Firmware</dt><dd class="col-sm-9">{{ $sensor->firmware_version }}</dd>

      <dt class="col-sm-3">Battery</dt><dd class="col-sm-9">{{ $sensor->battery_level }}%</dd>

      <dt class="col-sm-3">Last Seen</dt><dd class="col-sm-9">{{ optional($sensor->last_seen)->format('Y-m-d H:i') }}</dd>

      <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ $sensor->status }}</dd>

      <dt class="col-sm-3">Created</dt><dd class="col-sm-9">{{ optional($sensor->created_at)->toDayDateTimeString() }}</dd>

      <dt class="col-sm-3">Updated</dt><dd class="col-sm-9">{{ optional($sensor->updated_at)->toDayDateTimeString() }}</dd>

    </dl>

  </div>

</div>



                <!-- Recent Readings -->

                



                

            </div>

        </div>

    </div>

</div>





@include('user.include.footer')