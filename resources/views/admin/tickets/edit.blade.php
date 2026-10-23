@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">
      <div class="container-fluid">
          <span class="navbar-brand mb-0 h1 text-white">
            Edit Ticket
          </span>
          <div class="navbar-nav ms-auto ">
                        <a href="{{ route('admin.tickets.index') }}" class="btn themeBtn">Back</a>

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



  <form method="POST" action="{{ route('admin.tickets.update', $ticket) }}" class="bg-white p-3 border-0 rounded">

    @csrf

    @method('PUT')

    <div class="row g-3">

      <div class="col-md-6">

        <label class="form-label">Company</label>

        <select name="company_id" class="form-select" required>

          @foreach($companies as $company)

            <option value="{{ $company->id }}" {{ $ticket->company_id==$company->id?'selected':'' }}>{{ $company->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">User</label>

        <select name="user_id" class="form-select" required>

          @foreach($users as $user)

            <option value="{{ $user->id }}" {{ $ticket->user_id==$user->id?'selected':'' }}>{{ $user->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-12">

        <label class="form-label">Subject</label>

        <input type="text" name="subject" class="form-control" value="{{ $ticket->subject }}" required>

      </div>

      <div class="col-12">

        <label class="form-label">Description</label>

        <textarea name="description" class="form-control" rows="4" required>{{ $ticket->description }}</textarea>

      </div>

      <div class="col-md-6">

        <label class="form-label">Status</label>

        <select name="status" class="form-select" required>

          @foreach(['open','pending','resolved','closed'] as $status)

            <option value="{{ $status }}" {{ $ticket->status === $status ? 'selected' : '' }}>{{ $status }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Priority</label>

        <select name="priority" class="form-select" required>

          @foreach(['low','medium','high'] as $priority)

            <option value="{{ $priority }}" {{ $ticket->priority === $priority ? 'selected' : '' }}>{{ $priority }}</option>

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





