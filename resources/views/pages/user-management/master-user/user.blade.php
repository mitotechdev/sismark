@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Menu User</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible text-black" role="alert">
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

        {{-- Table View --}}
        <div class="card">
            <div class="card-header">
                <h5>Daftar Pengguna</h5>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewUser">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">Add User</span>
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="addNewUser" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form action="{{ route('user.store') }}" method="POST" novalidate class="needs-validation form-create">
                            @csrf
                            @method('POST')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <label for="full_name_user" class="form-label">Full Name</label>
                                            <input type="text" id="full_name_user" name="full_name" class="form-control" title="Full Name User" placeholder="Tn. Toni Serf" autocomplete="off" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="nickname" class="form-label">Nickname</label>
                                            <input type="text" id="nickname" name="nickname" class="form-control" title="Nickname User" placeholder="Tn. Toni" autocomplete="off" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="nickname" class="form-label">Gender</label>
                                            <select class="form-select" name="gender" id="gender" required title="Gender">
                                                <option value="" selected>Choose Gender...</option>
                                                <option value="Pria">Pria</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="employee_id" class="form-label">Employee ID</label>
                                            <input type="text" id="employee_id" name="employee_id" class="form-control" title="Employee ID" placeholder="0323.07.6.1.1.065" autocomplete="off" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" id="title" name="title" class="form-control" title="Title Employee" placeholder="Marketing" autocomplete="off" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="role" class="form-label">Role System</label>
                                            <select class="form-select select-box" name="role" id="role" required title="Role in System">
                                                <option value="" selected>Choose Role...</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="phone_number" class="form-label">Phone Number</label>
                                            <input type="text" id="phone_number" name="phone_number" class="form-control" title="Phone Number" placeholder="(+62) 8219 21281" autocomplete="off" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" id="email" name="email" class="form-control" title="Email" placeholder="example@mitoindonesia.com" autocomplete="off" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" id="username" name="username" class="form-control" title="Username" placeholder="toni.serf" autocomplete="off" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" id="password" name="password" class="form-control" title="Password" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="branch_id" class="form-label">Branch User</label>
                                            <select class="form-select" name="branch_id" id="branch_id" required title="Branch User">
                                                <option value="" selected>Choose branch...</option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table table-bordered table-striped datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th style="width: 5%">Active</th>
                                <th data-priority="2">ID</th>
                                <th data-priority="1">Name</th>
                                <th data-priority="5">Role System</th>
                                <th data-priority="4">Username</th>
                                <th data-priority="3">Act.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="{{ $user->status == "inactive" ? "bg-label-secondary" : "" }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="status" disabled {{ $user->status == "active" ? "checked" : "" }}>
                                        </div>
                                    </td>
                                    <td>{{ $user->employee_id }}</td>
                                    <td>{{ $user->nickname }}</td>
                                    {{-- <td>{{ $user->roles->pluck('name')->first() ?? <span class="bg-label-warning">unset</span> }}</td> --}}
                                    <td>
                                        @if ($user->roles->pluck('name')->first())
                                            {{ $user->roles->pluck('name')->first() }}
                                        @else
                                            <span class="badge bg-label-warning">Role belum ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-outline-warning"><i class='bx bxs-edit' ></i></a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline-block form-destroy">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class='bx bxs-trash' ></i></button>
                                        </form>

                                        @if ($user->status == "active")
                                        <form action="{{ route('user.deactivate', $user->id) }}" method="POST" class="d-inline-block form-edit">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Deactivate"><i class='bx bx-power-off'></i></button>
                                        </form>    
                                        @else
                                        <form action="{{ route('user.activate', $user->id) }}" method="POST" class="d-inline-block form-edit">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-info">Activate</button>
                                        </form>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- End Table View --}}
    </div>
@endsection