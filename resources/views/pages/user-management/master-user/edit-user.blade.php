@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Menu User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
            </ol>
        </nav>

        <div class="col-md-6">
            <form action="{{ route('user.update', $user->id) }}" method="POST" class="needs-validation form-edit">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-info alert-dismissible text-black" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible text-black" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endforeach
                        Update Information
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ $user->full_name }}" spellcheck="false" autocomplete="off" title="Full Name User" required>
                            </div>
                            <div class="col-12">
                                <label for="nickname" class="form-label">Nickname</label>
                                <input type="text" class="form-control @error('nickname') is-invalid @enderror" id="nickname" name="nickname" value="{{ $user->nickname }}" spellcheck="false" autocomplete="off" title="Nickname User" required>
                            </div>
                            <div class="col-12">
                                <label for="gender" class="form-label" title="Gender user">Gender</label>
                                <select class="form-select select-box @error('gender') is-invalid @enderror" name="gender" id="gender" required>
                                    <option value="" selected>Choose Gender...</option>
                                    <option value="Pria" {{ $user->gender == "Pria" ? "selected" : "" }}>Pria</option>
                                    <option value="Perempuan" {{ $user->gender == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="employee_id" class="form-label">Employee ID</label>
                                <input type="text" class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" value="{{ $user->employee_id }}" spellcheck="false" autocomplete="off" title="Employee ID user" required>
                            </div>
                            <div class="col-12">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $user->title }}" spellcheck="false" autocomplete="off" title="Title user" required>
                            </div>
                            <div class="col-12">
                                <label for="role" class="form-label">Role System</label>
                                <select class="form-select select-box @error('role') is-invalid @enderror" name="role" id="role" required title="Role in System">
                                    <option value="" selected>Choose Role...</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->id) ? "selected" : "" }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $user->phone_number }}" spellcheck="false" autocomplete="off" title="Phone Number User" required>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" spellcheck="false" autocomplete="off" title="Email User" required>
                            </div>
                            <div class="col-12">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ $user->username }}" spellcheck="false" autocomplete="off" title="Username User" required>
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="">
                            </div>
                            <div class="col-12">
                                <label for="branch" class="form-label" title="Branch user">Branch</label>
                                <select class="form-select select-box @error('branch') is-invalid @enderror" name="branch" id="branch" required>
                                    <option value="" selected>Choose Branch...</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ $user->branch_id == $branch->id ? "selected" : "" }} >{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-outline-secondary" href="{{ route('user.index') }}">Back</a>
                        <button class="btn btn-outline-primary" type="submit">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
