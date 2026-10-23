@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">

            <nav class="navbar navbar-expand-lg navbar-custom">

                <div class="container-fluid">

                    <span class="navbar-brand mb-0 h1">Plan Details</span>

                </div>

            </nav>



            <div class="main-content p-4">

                <div class="card bg-white p-3 border-0">

                    <div class="card-body">

                        <h4>{{ $plan->name }}</h4>

                        <p><strong>Price:</strong> ${{ number_format($plan->price,2) }} <span class="text-muted">{{ $plan->billing_interval ? ' - ' . $plan->billing_interval : '' }}</span></p>

                        @if($plan->description)

                            <p>{{ $plan->description }}</p>

                        @endif

                        <p><strong>Machines Included:</strong> {{ $plan->machines_included }}</p>

                        <p><strong>Companies on this plan:</strong> {{ $plan->companies->count() }}</p>



                        @if(!empty($plan->features))

                            <h5 class="mt-3">Features</h5>

                            <ul>

                                @foreach($plan->features as $feature)

                                    <li>{{ $feature }}</li>

                                @endforeach

                            </ul>

                        @endif



                        <a href="{{ route('admin.plans.edit', $plan) }}" class="btn btn-warning">Edit</a>

                        <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Back</a>

                    </div>

                </div>

            </div>

    </div>



@include('admin.include.footer')

