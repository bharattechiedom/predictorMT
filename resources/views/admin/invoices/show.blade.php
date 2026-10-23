@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">
      <div class="container-fluid">
          <span class="navbar-brand mb-0 h1 text-white">
            Invoice Details
          </span>
          <div class="navbar-nav ms-auto ">
              
      <a href="{{ route('admin.invoices.edit', $invoice) }}" class="btn btn-primary">Edit</a>

      <a href="{{ route('admin.invoices.index') }}" class="btn themeBtn">Back</a>
          </div>
      </div>
  </nav>
<div class="main-content p-4">
  <div class="card bg-white p-3 border-0">


  @if (session('success'))

    <div class="alert alert-success">{{ session('success') }}</div>

  @endif



  <div class="bg-white p-3 border-0 rounded">

    <dl class="row mb-0">

      <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $invoice->id }}</dd>

      <dt class="col-sm-3">Company</dt><dd class="col-sm-9">{{ optional($invoice->company)->name }}</dd>

      <dt class="col-sm-3">Amount</dt><dd class="col-sm-9">{{ $invoice->amount }}</dd>

      <dt class="col-sm-3">Billing Period</dt><dd class="col-sm-9">{{ optional($invoice->billing_period_start)->format('Y-m-d') }} → {{ optional($invoice->billing_period_end)->format('Y-m-d') }}</dd>

      <dt class="col-sm-3">Paid At</dt><dd class="col-sm-9">{{ optional($invoice->paid_at)->format('Y-m-d H:i') }}</dd>

      <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ $invoice->status }}</dd>

      <dt class="col-sm-3">External ID</dt><dd class="col-sm-9">{{ $invoice->external_invoice_id }}</dd>

    </dl>

  </div>

</div>

</div>



@include('admin.include.footer')





