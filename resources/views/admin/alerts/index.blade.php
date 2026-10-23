@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
                          Alerts
                        </span>

                        <div class="navbar-nav ms-auto ">
                          
    <a href="{{ route('admin.alerts.create') }}" class="btn themeBtn">Add Alert</a>


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

          <th>Machine</th>

          <th>Sensor</th>

          <th>Level</th>

          <th>Origin</th>

          <th>Actions</th>

        </tr>

      </thead>

      <tbody>

        @forelse($alerts as $alert)

        <tr>

          <td>{{ $alert->id }}</td>

          <td>{{ optional($alert->company)->name }}</td>

          <td>{{ optional($alert->machine)->name }}</td>

          <td>{{ optional($alert->sensor)->device_id }}</td>

          <td>{{ $alert->level }}</td>

          <td>{{ $alert->origin }}</td>

          <td class="d-flex gap-2">

            <a class="btn btn-sm btn-outline-primary btn-action" href="{{ route('admin.alerts.show', $alert) }}"><i class="fas fa-eye"></i></a>

            <a class="btn btn-sm btn-outline-warning btn-action" href="{{ route('admin.alerts.edit', $alert) }}"><i class="fas fa-edit"></i></a>

            <form action="{{ route('admin.alerts.destroy', $alert) }}" method="POST" onsubmit="return confirm('Delete this alert?');">

              @csrf

              @method('DELETE')

              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>

            </form>

          </td>

        </tr>

        @empty

        <tr><td colspan="7" class="text-center">No alerts found.</td></tr>

        @endforelse

      </tbody>

    </table>

  </div>



  <div class="mt-3">

    {{ $alerts->links() }}

  </div>

</div>

</div>



@include('admin.include.footer')





