@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">
      <div class="container-fluid">
          <span class="navbar-brand mb-0 h1 text-white">
            Tickets
          </span>
          <div class="navbar-nav ms-auto ">
                    <a href="{{ route('admin.tickets.create') }}" class="btn themeBtn">Add Ticket</a>
          </div>
      </div>
  </nav>
<div class="main-content p-4">
  <div class="card bg-white p-3 border-0">



  @if(session('success'))

    <div class="alert alert-success">{{ session('success') }}</div>

  @endif



  <div class="table-responsive bg-white p-2">

    <table class="table table-hover table-bordered">

      <thead class="bg-light">

        <tr>

          <th>#</th>

          <th>Company</th>

          <th>User</th>

          <th>Subject</th>

          <th>Status</th>

          <th>Priority</th>

          <th>Actions</th>

        </tr>

      </thead>

      <tbody>

        @forelse($tickets as $ticket)

        <tr>

          <td>{{ $ticket->id }}</td>

          <td>{{ optional($ticket->company)->name }}</td>

          <td>{{ optional($ticket->user)->name }}</td>

          <td>{{ $ticket->subject }}</td>

          <td>{{ $ticket->status }}</td>

          <td>{{ $ticket->priority }}</td>

          <td class="d-flex gap-2">

            <a class="btn btn-sm btn-outline-primary btn-action" href="{{ route('admin.tickets.show', $ticket) }}"><i class="fas fa-eye"></i></a>

            <a class="btn btn-sm btn-outline-warning btn-action" href="{{ route('admin.tickets.edit', $ticket) }}"><i class="fas fa-edit"></i></a>

            <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" onsubmit="return confirm('Delete this ticket?');">

              @csrf

              @method('DELETE')

              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>

            </form>

          </td>

        </tr>

        @empty

        <tr><td colspan="7" class="text-center">No tickets found.</td></tr>

        @endforelse

      </tbody>

    </table>

  </div>



  <div class="mt-3">

    {{ $tickets->links() }}

  </div>

</div>

</div>



@include('admin.include.footer')





