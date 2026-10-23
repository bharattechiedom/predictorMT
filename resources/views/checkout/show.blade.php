@include('include.header')

<div class="container mt-5">
    <div class="card p-4">
        <h3>{{ $plan->name }}</h3>
        <p>{{ $plan->billing_interval }}</p>
        <h4>{{ config('app.currency','CAD') }} {{ number_format($plan->price,2) }}</h4>

        <form method="POST" action="{{ route('checkout.create_session', $plan) }}">
            @csrf
            <button class="btn btn-success">Pay & Continue</button>
            <a href="{{ route('subscription') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@include('include.footer')
    