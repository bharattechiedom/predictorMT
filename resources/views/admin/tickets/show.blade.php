@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">
      <div class="container-fluid">
          <span class="navbar-brand mb-0 h1 text-white">
            Ticket Details
          </span>
          <div class="navbar-nav ms-auto ">
                          <a href="{{ route('admin.tickets.edit', $ticket) }}" class="btn btn-primary">Edit</a>

      <a href="{{ route('admin.tickets.index') }}" class="btn themeBtn ms-2">Back</a>
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

      <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $ticket->id }}</dd>

      <dt class="col-sm-3">Company</dt><dd class="col-sm-9">{{ optional($ticket->company)->name }}</dd>

      <dt class="col-sm-3">User</dt><dd class="col-sm-9">{{ optional($ticket->user)->name }}</dd>

      <dt class="col-sm-3">Subject</dt><dd class="col-sm-9">{{ $ticket->subject }}</dd>

      <dt class="col-sm-3">Description</dt><dd class="col-sm-9">{{ $ticket->description }}</dd>

      <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ $ticket->status }}</dd>

      <dt class="col-sm-3">Priority</dt><dd class="col-sm-9">{{ $ticket->priority }}</dd>

      <dt class="col-sm-3">Created</dt><dd class="col-sm-9">{{ optional($ticket->created_at)->toDayDateTimeString() }}</dd>

      <dt class="col-sm-3">Updated</dt><dd class="col-sm-9">{{ optional($ticket->updated_at)->toDayDateTimeString() }}</dd>

    </dl>

  </div>

</div>



@include('admin.include.footer')





