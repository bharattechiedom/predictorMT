@include('include.header')

    <!-- Our Pricing Start -->
    <div class="our-pricing-gold inner-page-border">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <span class="section-sub-title wow fadeInUp">Purchase a Subscription</span>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Choose the Right Industrial Solution</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Select the solution that best fits your monitoring, predictive maintenance, and analytics needs.</p>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
               @if(isset($plans) && $plans->count())
        @foreach($plans as $plan)

    <!-- Basic Plan -->
    <div class="col-xl-4 col-md-6">
        <div class="pricing-item-gold wow fadeInUp">

            <div class="pricing-item-header-box-gold">

                <div class="pricing-item-header-gold">
                    <div class="icon-box">
                        <i class="fa-solid fa-microchip fa-2x text-primary"></i>
                    </div>

                    <div class="pricing-item-title-gold">
                        <h2>{{ $plan->name }}</h2>
                    </div>
                </div>

                <div class="pricing-item-price-gold">
                    <h2>{{ config('app.currency', 'CAD') }} {{ number_format($plan->price, 2) }}
                      @if($plan->description)
            <sub>{{ $plan->description }}</sub>
            @endif
                    
                    </h2>
           <span>{{ $plan->billing_interval ?? '' }}</span>
                </div>

                <!-- <div class="pricing-item-contant-gold">
                     @if($plan->description)
            <p class="text-muted mt-2">{{ $plan->description }}</p>
            @endif
                </div> -->

            </div>

            <div class="pricing-item-body-gold">

                <div class="pricing-item-list-gold">
                    <h3>What's Included:</h3>
                    <ul>
              @if(!empty($plan->features) && is_array($plan->features))
              @foreach($plan->features as $feature)
              <li>{{ $feature }}</li>
              @endforeach
              @else
              <li>Access to member dashboard</li>
              @endif
            </ul>
                </div>

                <div class="pricing-item-btn-gold">
                     @if(auth()->check())
            <a href="{{ route('checkout.show', $plan) }}" class="btn btn-default">Choose Plan</a>
            @else
            <a href="{{ route('signup', ['plan' => $plan->id]) }}" class="btn btn-default">Sign Up to Choose</a>
            @endif
                </div>

            </div>

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
    </div>
    <!-- Our Pricing End -->
@include('include.footer')