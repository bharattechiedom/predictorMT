@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">

            <nav class="navbar navbar-expand-lg navbar-custom bg-black">

                <div class="container-fluid">

                    <span class="navbar-brand mb-0 h1 text-white">Add Company</span>

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



                        <form action="{{ route('admin.companies.store') }}" method="POST">

                            @csrf



                            <div class="mb-3">

                                <label class="form-label">Name</label>

                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Country</label>

                                <input type="text" name="country" class="form-control" value="{{ old('country') }}">

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Timezone</label>

                                <input type="text" name="timezone" class="form-control" value="{{ old('timezone', 'UTC') }}">

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Plan</label>

                                <select name="plan_id" class="form-select">

                                    <option value="">-- None --</option>

                                    @foreach($plans as $plan)

                                        <option value="{{ $plan->id }}">{{ $plan->name }} ({{ $plan->machines_included }} machines)</option>

                                    @endforeach

                                </select>

                            </div>



                            <div class="mt-3">

                                <button class="btn btn-primary">Create Company</button>

                                <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">Cancel</a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>



@include('admin.include.footer')

