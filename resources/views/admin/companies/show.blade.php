@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">

            <nav class="navbar navbar-expand-lg navbar-custom">

                <div class="container-fluid">

                    <span class="navbar-brand mb-0 h1">Company Details</span>

                </div>

            </nav>



            <div class="main-content p-4">

                <div class="card bg-white p-3 border-0">

                    <div class="card-body">

                        <h4>{{ $company->name }}</h4>

                        <p><strong>Country:</strong> {{ $company->country ?? 'N/A' }}</p>

                        <p><strong>Timezone:</strong> {{ $company->timezone }}</p>

                        <p><strong>Plan:</strong> {{ $company->plan ? $company->plan->name : 'None' }}</p>

                        <p><strong>Users:</strong> {{ $company->users->count() }}</p>

                        <p><strong>Machines:</strong> {{ $company->machines->count() }}</p>



                        <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-warning">Edit</a>

                        <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">Back</a>

                    </div>

                </div>

            </div>

        </div>



@include('admin.include.footer')

