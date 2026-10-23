@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
                         Subscriptions
                        </span>

                        <div class="navbar-nav ms-auto ">
                              <a href="{{ route('admin.subscriptions.create') }}" class="btn themeBtn">Add Subscription</a>


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

          <th>Plan</th>

          <th>Status</th>

          <th>Started</th>

          <th>Ended</th>

          <th>Actions</th>

        </tr>

      </thead>

      <tbody>

        @forelse($subscriptions as $subscription)

        <tr>

          <td>{{ $subscription->id }}</td>

          <td>{{ optional($subscription->company)->name }}</td>

          <td>{{ optional($subscription->plan)->name }}</td>

          <td>{{ $subscription->status }}</td>

          <td>{{ optional($subscription->started_at)->format('Y-m-d H:i') }}</td>

          <td>{{ optional($subscription->ended_at)->format('Y-m-d H:i') }}</td>

          <td class="d-flex gap-2">

            <a class="btn btn-sm btn-outline-primary btn-action" href="{{ route('admin.subscriptions.show', $subscription) }}"><i class="fas fa-eye"></i></a>

            <a class="btn btn-sm btn-outline-warning btn-action" href="{{ route('admin.subscriptions.edit', $subscription) }}"><i class="fas fa-edit"></i></a>

            <form action="{{ route('admin.subscriptions.destroy', $subscription) }}" method="POST" onsubmit="return confirm('Delete this subscription?');">

              @csrf

              @method('DELETE')

              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>

            </form>

          </td>

        </tr>

        @empty

        <tr><td colspan="7" class="text-center">No subscriptions found.</td></tr>

        @endforelse

      </tbody>

    </table>

  </div>



  <div class="mt-3">

    {{ $subscriptions->links() }}

  </div>

</div>

</div>



@include('admin.include.footer')





