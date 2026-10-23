@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
Sensor Readings
                        </span>

                        <div class="navbar-nav ms-auto ">
 <a href="{{ route('admin.sensor-readings.create') }}" class="btn themeBtn">Add Reading</a>
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

          <th>Timestamp</th>

          <th>Sensor</th>

          <th>Machine</th>

          <th>Value</th>

          <th>Actions</th>

        </tr>

      </thead>

      <tbody>

        @forelse($readings as $reading)

        <tr>

          <td>{{ $reading->id }}</td>

          <td>{{ optional($reading->timestamp)->format('Y-m-d H:i') }}</td>

          <td>{{ optional($reading->sensor)->device_id }}</td>

          <td>{{ optional($reading->machine)->name }}</td>

          <td>{{ $reading->value_float }}</td>

          <td class="d-flex gap-2">

            <a class="btn btn-sm btn-outline-primary btn-action" href="{{ route('admin.sensor-readings.show', $reading) }}"><i class="fas fa-eye"></i></a>

            <a class="btn btn-sm btn-outline-warning btn-action" href="{{ route('admin.sensor-readings.edit', $reading) }}"><i class="fas fa-edit"></i></a>

            <form action="{{ route('admin.sensor-readings.destroy', $reading) }}" method="POST" onsubmit="return confirm('Delete this reading?');">

              @csrf

              @method('DELETE')

              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>

            </form>

          </td>

        </tr>

        @empty

        <tr><td colspan="6" class="text-center">No readings found.</td></tr>

        @endforelse

      </tbody>

    </table>

  </div>



  <div class="mt-3">

    {{ $readings->links() }}

  </div>

</div>

</div>



@include('admin.include.footer')





