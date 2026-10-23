@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
                        Maintenance Task Details
                        </span>

                        <div class="navbar-nav ms-auto ">
                          
        <a href="{{ route('admin.maintenance-tasks.edit', $task) }}" class="btn btn-primary">Edit</a>

      <a href="{{ route('admin.maintenance-tasks.index') }}" class="btn themeBtn ms-2">Back</a>


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

      <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $task->id }}</dd>

      <dt class="col-sm-3">Company</dt><dd class="col-sm-9">{{ optional($task->company)->name }}</dd>

      <dt class="col-sm-3">Machine</dt><dd class="col-sm-9">{{ optional($task->machine)->name }}</dd>

      <dt class="col-sm-3">Created By</dt><dd class="col-sm-9">{{ optional($task->createdBy)->name ?? $task->created_by }}</dd>

      <dt class="col-sm-3">Assigned To</dt><dd class="col-sm-9">{{ optional($task->assignedTo)->name ?? ($task->assigned_to ?: 'Unassigned') }}</dd>

      <dt class="col-sm-3">Scheduled At</dt><dd class="col-sm-9">{{ optional($task->scheduled_at)->format('Y-m-d H:i') }}</dd>

      <dt class="col-sm-3">Completed At</dt><dd class="col-sm-9">{{ optional($task->completed_at)->format('Y-m-d H:i') }}</dd>

      <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ $task->status }}</dd>

      <dt class="col-sm-3">Notes</dt><dd class="col-sm-9">{{ $task->notes }}</dd>

      <dt class="col-sm-3">Parts Required</dt><dd class="col-sm-9"><pre class="mb-0" style="white-space:pre-wrap">{{ is_array($task->parts_required) ? json_encode($task->parts_required, JSON_PRETTY_PRINT) : $task->parts_required }}</pre></dd>

      <dt class="col-sm-3">Cost Estimate</dt><dd class="col-sm-9">{{ $task->cost_estimate }}</dd>

    </dl>

  </div>

</div>
</div>



@include('admin.include.footer')





