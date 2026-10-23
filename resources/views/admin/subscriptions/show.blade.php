@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">
  <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                    <div class="container-fluid">

                        <span class="navbar-brand mb-0 h1 text-white">
                         Subscription Details
                        </span>

                        <div class="navbar-nav ms-auto ">
                                    <a href="{{ route('admin.subscriptions.edit', $subscription) }}" class="btn btn-primary">Edit</a>

      <a href="{{ route('admin.subscriptions.index') }}" class="btn themeBtn ms-2">Back</a>


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

      <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $subscription->id }}</dd>

      <dt class="col-sm-3">Company</dt><dd class="col-sm-9">{{ optional($subscription->company)->name }}</dd>

      <dt class="col-sm-3">Plan</dt><dd class="col-sm-9">{{ optional($subscription->plan)->name }}</dd>

      <dt class="col-sm-3">Status</dt><dd class="col-sm-9">{{ $subscription->status }}</dd>

      <dt class="col-sm-3">Started At</dt><dd class="col-sm-9">{{ optional($subscription->started_at)->format('Y-m-d H:i') }}</dd>

      <dt class="col-sm-3">Ended At</dt><dd class="col-sm-9">{{ optional($subscription->ended_at)->format('Y-m-d H:i') }}</dd>

      <dt class="col-sm-3">External ID</dt><dd class="col-sm-9">{{ $subscription->external_subscription_id }}</dd>

    </dl>

  </div>

</div>
</div>  



@include('admin.include.footer')





