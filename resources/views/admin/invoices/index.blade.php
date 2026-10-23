@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">
      <div class="container-fluid">
          <span class="navbar-brand mb-0 h1 text-white">
            Invoices
          </span>
          <div class="navbar-nav ms-auto ">
              <a href="{{ route('admin.invoices.create') }}" class="btn themeBtn">Add Invoice</a>
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

          <th>Amount</th>

          <th>Period</th>

          <th>Status</th>

          <th>Actions</th>

        </tr>

      </thead>

      <tbody>

        @forelse($invoices as $invoice)

        <tr>

          <td>{{ $invoice->id }}</td>

          <td>{{ optional($invoice->company)->name }}</td>

          <td>{{ $invoice->amount }}</td>

          <td>{{ optional($invoice->billing_period_start)->format('Y-m-d') }} → {{ optional($invoice->billing_period_end)->format('Y-m-d') }}</td>

          <td>{{ $invoice->status }}</td>

          <td class="d-flex gap-2">

            <a class="btn btn-sm btn-outline-primary btn-action" href="{{ route('admin.invoices.show', $invoice) }}"><i class="fas fa-eye"></i></a>

            <a class="btn btn-sm btn-outline-warning btn-action" href="{{ route('admin.invoices.edit', $invoice) }}"><i class="fas fa-edit"></i></a>

            <form action="{{ route('admin.invoices.destroy', $invoice) }}" method="POST" onsubmit="return confirm('Delete this invoice?');">

              @csrf

              @method('DELETE')

              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>

            </form>

          </td>

        </tr>

        @empty

        <tr><td colspan="6" class="text-center">No invoices found.</td></tr>

        @endforelse

      </tbody>

    </table>

  </div>



  <div class="mt-3">

    {{ $invoices->links() }}

  </div>

</div>
</div>



@include('admin.include.footer')





