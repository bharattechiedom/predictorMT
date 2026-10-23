@include('include.header')

<style>
  #plans {
    padding: 30px 0 80px;
    text-align: center;
  }

  #plans h2 {
    font-size: 30px;
    font-weight: 600;
    color: #51ade5;
    margin-bottom: 10px;
    font-family: 'Poppins', sans-serif;
    text-transform: capitalize;
  }

  #plans p.subtitle {
    color: #666;
    font-size: 16px;
    margin-bottom: 40px;
  }

  .plan-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
    padding: 40px 25px;
    text-align: left;
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
  }

  .plan-card:hover {
    transform: translateY(-5px);
  }

  .plan-card h4 {
    font-size: 25px;
    font-weight: 700;
    color: #000;
    margin-bottom: 10px;
    font-family: 'Poppins', sans-serif;
    text-transform: capitalize;
  }

  .plan-card h2 {
    font-size: 28px;
    color: #000;
    font-weight: 700;
    margin-bottom: 5px;
  }

  .plan-card span {
    font-size: 13px;
    color: #777;
    display: block;
    margin-bottom: 25px;
  }

  .plan-card ul {
    list-style: none;
    padding: 0;
    margin-bottom: auto;
    flex-grow: 1;
  }

  .plan-card ul li {
    color: #555;
    font-size: 15px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
  }

  .plan-card ul li::before {
    content: "\2713";
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background-color: #51ade5;
    color: #ffffff;
    font-size: 13px;
    font-weight: 700;
    margin-right: 10px;
    flex-shrink: 0;
    text-align: center;
    line-height: 1;
  }

  .plan-card .btn {
    margin-top: 25px;
  }

  .row>[class*='col-'] {
    display: flex;
  }

  .plan-card {
    flex: 1;
  }

  @media (max-width: 992px) {
    .plan-card {
      margin-bottom: 30px;
    }
  }
</style>

<div class="condition-div">

  <div class="custom-breadcrumb mt-0">
    <span class="home-icon"><i class="fa-solid fa-house"></i></span>
    <a href="{{ route('home') }}">Home</a>
    <span class="arrow">›</span>
    <a href="#">Pricing Plan</a>
    <span class="arrow">›</span>
  </div>

  <section id="plans">
    <div class="container">
      <h2>Purchase a Subscription</h2>
      <p class="subtitle">Choose the plan that works for you.</p>

      <div class="row justify-content-center">
        @if(isset($plans) && $plans->count())
        @foreach($plans as $plan)
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="plan-card">
            <h4>{{ $plan->name }}</h4>
            <h2>{{ config('app.currency', 'CAD') }} {{ number_format($plan->price, 2) }}</h2>
            <span>{{ $plan->billing_interval ?? '' }}</span>
            @if($plan->description)
            <p class="text-muted mt-2">{{ $plan->description }}</p>
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
            <a href="{{ route('checkout.show', $plan) }}" class="btn btn-primary">Choose Plan</a>
            @else
            <a href="{{ route('signup', ['plan' => $plan->id]) }}" class="btn btn-primary">Sign Up to Choose</a>
            @endif
          </div>
        </div>
        @endforeach
        @else
        <div class="col-12 text-center">
          <p class="text-muted">No subscription plans are available right now. Please check back later.</p>
        </div>
        @endif
      </div>
    </div>
  </section>

</div>

@include('include.footer')