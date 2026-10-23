@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
                          Maintenance Tasks
                        </span>

                        <div class="navbar-nav ms-auto ">
                          
        <a href="{{ route('admin.maintenance-tasks.create') }}" class="btn themeBtn">Add Task</a>


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

          <th>Scheduled</th>

          <th>Status</th>

          <th>Actions</th>

        </tr>

      </thead>

      <tbody>

        @forelse($tasks as $task)

        <tr>

          <td>{{ $task->id }}</td>

          <td>{{ optional($task->company)->name }}</td>

          <td>{{ optional($task->machine)->name }}</td>

          <td>{{ optional($task->scheduled_at)->format('Y-m-d H:i') }}</td>

          <td>{{ $task->status }}</td>

          <td class="d-flex gap-2">

            <a class="btn btn-sm btn-outline-primary btn-action" href="{{ route('admin.maintenance-tasks.show', $task) }}"><i class="fas fa-eye"></i></a>

            <a class="btn btn-sm btn-outline-warning btn-action" href="{{ route('admin.maintenance-tasks.edit', $task) }}"><i class="fas fa-edit"></i></a>

            <form action="{{ route('admin.maintenance-tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?');">

              @csrf

              @method('DELETE')

              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>

            </form>

          </td>

        </tr>

        @empty

        <tr><td colspan="6" class="text-center">No tasks found.</td></tr>

        @endforelse

      </tbody>

    </table>

  </div>



  <div class="mt-3">

    {{ $tasks->links() }}

  </div>

</div>

</div>



@include('admin.include.footer')





