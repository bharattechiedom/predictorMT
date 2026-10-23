@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">
      <div class="container-fluid">
          <span class="navbar-brand mb-0 h1 text-white">
            Add Invoice
          </span>
          <div class="navbar-nav ms-auto ">
                <a href="{{ route('admin.invoices.index') }}" class="btn themeBtn">Back</a>
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



  <form method="POST" action="{{ route('admin.invoices.store') }}" class="bg-white p-3 border-0 rounded">

    @csrf

    <div class="row g-3">

      <div class="col-md-6">

        <label class="form-label">Company</label>

        <select name="company_id" class="form-select" required>

          @foreach($companies as $company)

            <option value="{{ $company->id }}">{{ $company->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Amount</label>

        <input type="number" step="0.01" name="amount" class="form-control" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Billing Period Start</label>

        <input type="date" name="billing_period_start" class="form-control" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Billing Period End</label>

        <input type="date" name="billing_period_end" class="form-control" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Paid At</label>

        <input type="datetime-local" name="paid_at" class="form-control">

      </div>

      <div class="col-md-6">

        <label class="form-label">Status</label>

        <select name="status" class="form-select" required>

          @foreach(['pending','paid','failed'] as $status)

            <option value="{{ $status }}">{{ $status }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">External Invoice ID</label>

        <input type="text" name="external_invoice_id" class="form-control">

      </div>

    </div>

    <div class="mt-3">

      <button type="submit" class="btn btn-primary">Create</button>

    </div>

  </form>

</div>
</div>


@include('admin.include.footer')





