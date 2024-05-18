@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold"><span class="text-muted fw-light">Menu Role</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Permission</li>
            </ol>
        </nav>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewPermission">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">Add Permission</span>
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="addNewPermission" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('permission.store') }}" method="POST" class="needs-validation form-create">
                            @csrf
                            @method('POST')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Information Permission</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="name" class="form-label">Name Permisison</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Create Post" title="Name Permission" spellcheck="false" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="for_menu" class="form-label">For Menu</label>
                                            <input type="text" name="for_menu" id="for_menu" class="form-control" placeholder="Menu Posts" title="For Menu" spellcheck="false" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="tag" class="form-label">Tag</label>
                                            <input type="text" name="tag" id="tag" class="form-control" placeholder="Create" title="Tag for" spellcheck="false" required>
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
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Name</th>
                            <th>For</th>
                            <th>Tag</th>
                            <th>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->for }}</td>
                                <td>{{ $permission->tag }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPermission-{{ $permission->id }}">
                                        <span class="ms-1">Edit</span>
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="editPermission-{{ $permission->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('permission.update', $permission->id) }}" method="POST" class="needs-validation form-edit">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Information Permission</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label for="name" class="form-label">Name Permisison</label>
                                                                <input type="text" name="name" id="name" class="form-control" placeholder="Create Post" title="Name Permission" spellcheck="false" value="{{ $permission->name }}" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="for_menu" class="form-label">For Menu</label>
                                                                <input type="text" name="for_menu" id="for_menu" class="form-control" placeholder="Menu Posts" title="For Menu" spellcheck="false" value="{{ $permission->for }}" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="tag" class="form-label">Tag</label>
                                                                <input type="text" name="tag" id="tag" class="form-control" placeholder="Create" title="Tag for" spellcheck="false" value="{{ $permission->tag }}" required>
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

                                    <form action="{{ route('permission.destroy', $permission->id) }}" method="POST" class="needs-validation d-inline-block form-destroy">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection