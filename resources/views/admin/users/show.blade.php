@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">

            <nav class="navbar navbar-expand-lg navbar-custom">

                <div class="container-fluid">

                    <span class="navbar-brand mb-0 h1">User Details</span>

                </div>

            </nav>



            <div class="main-content p-4">

                <div class="card bg-white p-3 border-0">

                    <div class="card-body">

                        <h4>{{ $user->name }}</h4>

                        <p><strong>Email:</strong> {{ $user->email }}</p>

                        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>

                        <p><strong>Company:</strong> {{ $user->company ? $user->company->name : 'None' }}</p>

                        <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>



                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Edit</a>

                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>

                    </div>

                </div>

            </div>

    </div>



@include('admin.include.footer')

