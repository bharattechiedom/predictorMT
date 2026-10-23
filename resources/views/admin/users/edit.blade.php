@include('admin.include.header')



<div class="col-md-9 col-lg-10 p-0">

            <nav class="navbar navbar-expand-lg navbar-custom">

                <div class="container-fluid">

                    <span class="navbar-brand mb-0 h1">Edit User</span>

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



                        <form action="{{ route('admin.users.update', $user) }}" method="POST">

                            @csrf

                            @method('PUT')



                            <div class="mb-3">

                                <label class="form-label">Company</label>

                                <select name="company_id" class="form-select">

                                    <option value="">-- None --</option>

                                    @foreach($companies as $company)

                                        <option value="{{ $company->id }}" @if($user->company_id == $company->id) selected @endif>{{ $company->name }}</option>

                                    @endforeach

                                </select>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Name</label>

                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Email</label>

                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Password (leave blank to keep current)</label>

                                <input type="password" name="password" class="form-control">

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Phone</label>

                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">

                            </div>



                            <div class="mb-3">

                                <label class="form-label">Role</label>

                                <select name="role" class="form-select" required>

                                    @php

                                        $roles = ['superadmin','admin','manager','technician','viewer'];

                                    @endphp

                                    @foreach($roles as $r)

                                        <option value="{{ $r }}" @if($user->role == $r) selected @endif>{{ ucfirst($r) }}</option>

                                    @endforeach

                                </select>

                            </div>



                            <div class="mt-3">

                                <button class="btn btn-primary">Update User</button>

                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>



@include('admin.include.footer')

