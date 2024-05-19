@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold"><span class="text-muted fw-light">Branches</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Branches</li>
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

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewBranch">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">Add Data</span>
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="addNewBranch" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form action="{{ route('branch.store') }}" method="POST" class="needs-validation form-create">
                            @csrf
                            @method('POST')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="code_branch" class="form-label">Code Branch</label>
                                            <input type="text" id="code_branch" name="code" class="form-control" title="Code branch" placeholder="PKU" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="name_branch" class="form-label">Name Branch</label>
                                            <input type="text" id="name_branch" name="name" class="form-control" title="Name Branch" placeholder="Head Office Pekanbaru" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="npwp" class="form-label">NPWP</label>
                                            <input type="text" id="npwp" name="npwp" class="form-control" title="NPWP" placeholder="96.007.415.1-216.000" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" id="address" name="address" class="form-control" title="Address Branch" placeholder="Jl. Soekarno Hatta" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="phone_number" class="form-label">Phone Branch</label>
                                            <input type="text" id="phone_number" name="phone" class="form-control" title="Phone Number Branch" placeholder="(0761) 5795004" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="pic_branch" class="form-label">PIC</label>
                                            <input type="text" id="pic_branch" name="pic" class="form-control" title="PIC Branch" placeholder="Tn. Taufan" required>
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
                <table class="table table-bordered datatable" style="font-size: 14px">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Code</th>
                            <th data-priority="1">Name Branch</th>
                            <th>NPWP</th>
                            <th>Phone</th>
                            <th>PIC</th>
                            <th>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($branches as $branch)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $branch->code }}</td>
                                <td>{{ $branch->name }}</td>
                                <td>{{ $branch->npwp }}</td>
                                <td>{{ $branch->phone }}</td>
                                <td>{{ $branch->pic }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#updateBranch-{{$branch->id}}">
                                        <i class='bx bxs-edit'></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="updateBranch-{{$branch->id}}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <form action="{{ route('branch.update', $branch->id) }}" method="POST" class="needs-validation form-edit">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel1">Information Update</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            <div class="col-12">
                                                                <label for="code_branch" class="form-label">Code Branch</label>
                                                                <input type="text" id="code_branch" name="code" class="form-control" title="Code branch" placeholder="PKU" value="{{ $branch->code }}" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="name_branch" class="form-label">Name Branch</label>
                                                                <input type="text" id="name_branch" name="name" class="form-control" title="Name Branch" placeholder="Head Office Pekanbaru" value="{{ $branch->name }}" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="npwp" class="form-label">NPWP</label>
                                                                <input type="text" id="npwp" name="npwp" class="form-control" title="NPWP" placeholder="96.007.415.1-216.000" value="{{ $branch->npwp }}" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="address" class="form-label">Address</label>
                                                                <input type="text" id="address" name="address" class="form-control" title="Address Branch" placeholder="Jl. Soekarno Hatta" value="{{ $branch->address }}" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="phone_number" class="form-label">Phone Branch</label>
                                                                <input type="text" id="phone_number" name="phone" class="form-control" title="Phone Number Branch" placeholder="(0761) 5795004" value="{{ $branch->phone }}" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="pic_branch" class="form-label">PIC</label>
                                                                <input type="text" id="pic_branch" name="pic" class="form-control" title="PIC Branch" placeholder="Tn. Taufan" value="{{ $branch->pic }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save Change</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <form action="" method="POST" class="needs-validation form-destroy d-inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class='bx bxs-trash'></i></button>
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