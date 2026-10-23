@include('include.header')


<div class="condition-div">

  <div class="custom-breadcrumb mt-0">
    <span class="home-icon"><i class="fa-solid fa-house"></i></span>
    <a href="{{ route('home') }}">Home</a>
    <span class="arrow">›</span>
    <a href="#">Pricing Plan</a>
    <span class="arrow">›</span>
  </div>

  <section id="plans" class="subscriptionPlan text-center">
    <div class="container">
      <h2>Purchase a Subscription</h2>
      <p class="text-white">Choose the plan that works for you.</p>

      <div class="row justify-content-center text-white mt-5">
        @if(isset($plans) && $plans->count())
        @foreach($plans as $plan)
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="plan-card">
            <h4>{{ $plan->name }}</h4>
            <h2 class="m-0">{{ config('app.currency', 'CAD') }} {{ number_format($plan->price, 2) }}</h2>
            <span>{{ $plan->billing_interval ?? '' }}</span>
            @if($plan->description)
            <small class="mt-2 text-white">{{ $plan->description }}</small>
            @endif
            <ul>
              @if(!empty($plan->features) && is_array($plan->features))
              @foreach($plan->features as $feature)
              <li>{{ $feature }}</li>
              @endforeach
              @else
              <li>Access to member dashboard</li>
              @endif
            </ul>
            @if(auth()->check())
            <a href="{{ route('checkout.show', $plan) }}" class="btn btn_plan">Choose Plan</a>
            @else
            <a href="{{ route('signup', ['plan' => $plan->id]) }}" class="btn btn_plan">Sign Up to Choose</a>
            @endif
          </div>
        </div>
        @endforeach
        @else
        <div class="col-12 text-center">
          <p class="text-white">No subscription plans are available right now. Please check back later.</p>
        </div>
        @endif
      </div>
    </div>
  </section>
  </div>

</div>

@include('include.footer')