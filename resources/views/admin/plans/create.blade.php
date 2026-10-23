@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">

            <nav class="navbar navbar-expand-lg navbar-custom">

                <div class="container-fluid">

                    <span class="navbar-brand mb-0 h1">Add Plan</span>

                </div>

            </nav>



            <div class="main-content p-4">

                    <div class="card bg-white p-3 border-0">

                    <div class="card-body">



                        @if($errors->any())

                            <div class="alert alert-danger">

                                <ul class="mb-0">

                                    @foreach($errors->all() as $error)

                                        <li>{{ $error }}</li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif



                        <form action="{{ route('admin.plans.store') }}" method="POST">

                            @csrf



                            <div class="mb-3">

                                <label class="form-label">Name</label>

                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Price</label>

                                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', '0.00') }}" required>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Machines Included</label>

                                <input type="number" name="machines_included" class="form-control" value="{{ old('machines_included', 1) }}" required>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Billing Interval (label)</label>

                                <input type="text" name="billing_interval" class="form-control" value="{{ old('billing_interval') }}" placeholder="e.g. per machine / month">

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Short Description</label>

                                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Features (one per line)</label>

                                <textarea name="features_text" class="form-control" rows="6" placeholder="30h Fast generations\nUnlimited Relaxed generations\nGeneral commercial terms\nAccess to member dashboard\nOptional credit top ups\nSetup fees, sensor costs, and dashboard access">{{ old('features_text') }}</textarea>

                            </div>



                            <div class="mt-3">

                                <button class="btn btn-primary">Create Plan</button>

                                <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Cancel</a>

                            </div>

                        </form>

                    </div>

                </div>



        @include('admin.include.footer')

