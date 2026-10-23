@include('include.header')

<div class="container mt-5 text-center">
    <h2>✅ Payment Successful</h2>
    <p>
        Amount Paid: {{ strtoupper($payment->currency) }}
        {{ number_format($payment->amount, 2) }}
    </p>

    <a href="{{ route('signup') }}" class="btn btn-primary">
        Continue to Registration
    </a>
</div>

@include('include.footer')
