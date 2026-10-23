@include('admin.include.header')


<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">
      <div class="container-fluid">
          <span class="navbar-brand mb-0 h1 text-white">
            Edit Subscription
          </span>
          <div class="navbar-nav ms-auto ">
            <a href="{{ route('admin.subscriptions.index') }}" class="btn themeBtn ms-2">Back</a>
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



  <form method="POST" action="{{ route('admin.subscriptions.update', $subscription) }}" class="bg-white p-3 border-0 rounded">

    @csrf

    @method('PUT')

    <div class="row g-3">

      <div class="col-md-6">

        <label class="form-label">Company</label>

        <select name="company_id" class="form-select" required>

          @foreach($companies as $company)

            <option value="{{ $company->id }}" {{ $subscription->company_id==$company->id?'selected':'' }}>{{ $company->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Plan</label>

        <select name="plan_id" class="form-select" required>

          @foreach($plans as $plan)

            <option value="{{ $plan->id }}" {{ $subscription->plan_id==$plan->id?'selected':'' }}>{{ $plan->name }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Status</label>

        <select name="status" class="form-select" required>

          @foreach(['active','trialing','past_due','cancelled'] as $status)

            <option value="{{ $status }}" {{ $subscription->status === $status ? 'selected' : '' }}>{{ $status }}</option>

          @endforeach

        </select>

      </div>

      <div class="col-md-6">

        <label class="form-label">Started At</label>

        <input type="datetime-local" name="started_at" class="form-control" value="{{ optional($subscription->started_at)->format('Y-m-d\\TH:i') }}" required>

      </div>

      <div class="col-md-6">

        <label class="form-label">Ended At</label>

        <input type="datetime-local" name="ended_at" class="form-control" value="{{ optional($subscription->ended_at)->format('Y-m-d\\TH:i') }}">

      </div>

      <div class="col-md-6">

        <label class="form-label">External Subscription ID</label>

        <input type="text" name="external_subscription_id" class="form-control" value="{{ $subscription->external_subscription_id }}">

      </div>

    </div>

    <div class="mt-3">

      <button type="submit" class="btn btn-primary">Update</button>

    </div>

  </form>

</div>

</div>



@include('admin.include.footer')





