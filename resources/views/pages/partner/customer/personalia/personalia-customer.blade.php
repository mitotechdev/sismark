@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Customer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Personalia</li>
            </ol>
        </nav>

        {{-- Alert Success --}}
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

        <div class="card mb-3">
            <div class="card-header">
                <h5>Data Person Customer</h5>
                @can('create-personalia')
                <button type="button" class="btn btn-primary mb-sm-0 mb-2" data-bs-toggle="modal" data-bs-target="#addPersonalia">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">Add Personalia</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addPersonalia" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('personalia.store') }}" method="POST" class="needs-validation form-create">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Information Personalia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" title="Name Personalia" placeholder="Tn. Toni" required>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <input type="text" class="form-control" name="role" id="role" title="Role Personalia" placeholder="Manager" required>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" name="phone" id="phone" title="Phone Personalia" placeholder="(+62) XXXX XXXX" required>
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
                @endcan
            </div>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table table-bordered table-striped datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="1">Name</th>
                                <th data-priority="2">Role</th>
                                <th data-priority="4">Phone</th>
                                <th data-priority="3">Act.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer->personalia as $key => $personal)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $personal->name }}</td>
                                    <td>{{ $personal->role }}</td>
                                    <td>{{ $personal->phone }}</td>
                                    <td>
                                        @can('create-personalia')
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPersonalia-{{ $personal->id }}"><span class="ms-1">Edit</span></button>
                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="editPersonalia-{{ $personal->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('personalia.update', $personal->id) }}" method="POST" class="needs-validation form-edit">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Information Update</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-3">
                                                                    <label for="name" class="form-label">Name</label>
                                                                    <input type="text" class="form-control" name="name" id="name" title="Name Personalia" placeholder="Tn. Toni" value="{{ $personal->name }}" required>
                                                                </div>
                                                                <div class="col-md-12 mb-3">
                                                                    <label for="role" class="form-label">Role</label>
                                                                    <input type="text" class="form-control" name="role" id="role" title="Role Personalia" placeholder="Manager" value="{{ $personal->role }}" required>
                                                                </div>
                                                                <div class="col-md-12 mb-3">
                                                                    <label for="phone" class="form-label">Phone</label>
                                                                    <input type="text" class="form-control" name="phone" id="phone" title="Phone Personalia" placeholder="(+62) XXXX XXXX" value="{{ $personal->phone }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endcan
                                        @can('delete-personalia')
                                        <form action="{{ route('personalia.destroy', $personal->id) }}" method="POST" class="needs-validation d-inline-block form-destroy">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection