@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">

<nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">

                            <i class="fas fa-building me-2"></i>

                            Machines

                        </span>

                        <div class="navbar-nav ms-auto">

                            <a href="{{ route('admin.machines.create') }}" class="btn themeBtn">Add Machine</a>

                        </div>

                    </div>

                </nav>


<div class="main-content">

<div class="card table-card bg-white p-3">


  @if(session('success'))

    <div class="alert alert-success">{{ session('success') }}</div>

  @endif



  <div class="table-responsive bg-white p-2">

    <table class="table table-hover table-bordered">

      <thead class="bg-light">

        <tr>

          <th>#</th>

          <th>Name</th>

          <th>Company</th>

          <th>Type</th>

          <th>Serial</th>

          <th>Status</th>

          <th>Actions</th>

        </tr>

      </thead>

      <tbody>

        @forelse($machines as $machine)

        <tr>

          <td>{{ $machine->id }}</td>

          <td>{{ $machine->name }}</td>

          <td>{{ optional($machine->company)->name }}</td>

          <td>{{ $machine->machine_type }}</td>

          <td>{{ $machine->serial_number }}</td>

          <td>{{ $machine->status }}</td>

          <td class="d-flex gap-2">

            <a class="btn btn-sm btn-outline-primary btn-action" href="{{ route('admin.machines.show', $machine) }}"><i class="fas fa-eye"></i></a>

            <a class="btn btn-sm btn-outline-warning btn-action" href="{{ route('admin.machines.edit', $machine) }}"><i class="fas fa-edit"></i></a>

            <form action="{{ route('admin.machines.destroy', $machine) }}" method="POST" onsubmit="return confirm('Delete this machine?');">

              @csrf

              @method('DELETE')

              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>

            </form>

          </td>

        </tr>

        @empty

        <tr><td colspan="7" class="text-center">No machines found.</td></tr>

        @endforelse

      </tbody>

    </table>

  </div>



  <div class="mt-3">

    {{ $machines->links() }}

  </div>

</div>

</div>


@include('admin.include.footer')





