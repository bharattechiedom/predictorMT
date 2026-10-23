@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">

                           Sensors
                        </span>

                        <div class="navbar-nav ms-auto ">

      <a href="{{ route('admin.sensors.create') }}" class="btn themeBtn">Add Sensor</a>
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

          <th>Device ID</th>

          <th>Type</th>

          <th>Machine</th>

          <th>Status</th>

          <th>Last Seen</th>

          <th>Actions</th>

        </tr>

      </thead>

      <tbody>

        @forelse($sensors as $sensor)

        <tr>

          <td>{{ $sensor->id }}</td>

          <td>{{ $sensor->device_id }}</td>

          <td>{{ $sensor->sensor_type }}</td>

          <td>{{ optional($sensor->machine)->name }}</td>

          <td>{{ $sensor->status }}</td>

          <td>{{ optional($sensor->last_seen)->format('Y-m-d H:i') }}</td>

          <td class="d-flex gap-2">

            <a class="btn btn-sm btn-outline-primary btn-action" href="{{ route('admin.sensors.show', $sensor) }}"><i class="fas fa-eye"></i></a>

            <a class="btn btn-sm btn-outline-warning btn-action" href="{{ route('admin.sensors.edit', $sensor) }}"><i class="fas fa-edit"></i></a>

            <form action="{{ route('admin.sensors.destroy', $sensor) }}" method="POST" onsubmit="return confirm('Delete this sensor?');">

              @csrf

              @method('DELETE')

              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>

            </form>

          </td>

        </tr>

        @empty

        <tr><td colspan="7" class="text-center">No sensors found.</td></tr>

        @endforelse

      </tbody>

    </table>

  </div>



  <div class="mt-3">

    {{ $sensors->links() }}

  </div>

</div>
</div>



@include('admin.include.footer')





