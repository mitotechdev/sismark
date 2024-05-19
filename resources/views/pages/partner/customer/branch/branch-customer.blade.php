@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Customer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Branch Customer</li>
            </ol>
        </nav>

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
        
        <div class="card">
            <div class="card-header">
                <h5>Branch Customer</h5>
                @can('create-brancher-customer')
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addBranchCustomer">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">Add Branch</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addBranchCustomer" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form action="{{ route('customer-branch.store') }}" method="POST" novalidate class="needs-validation form-create">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Information Branch</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3 mb-3">
                                        <div class="col-4">
                                            <input type="text" class="form-control" id="name" name="name_branch" placeholder="Name Branch" title="Name Branch" spellcheck="false" required>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" class="form-control" id="type_branch" name="type_branch" placeholder="Type Branch" title="Type Branch" required>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" class="form-control" id="pic_branch" name="pic_branch" placeholder="PIC Branch" title="PIC Branch" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <input type="text" class="form-control" id="address_branch" name="address_branch" placeholder="Address Branch" title="Address" spellcheck="false" required>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Deskripsikan pabrik / branch / Kapasitas Produksi disini" name="desc_branch" style="height: 100px" spellcheck="false" required></textarea>
                                            <label for="floatingTextarea2">Description</label>
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
                                <th data-priority="1">Name Branch</th>
                                <th data-priority="2">Type</th>
                                <th data-priority="4">PIC</th>
                                <th data-priority="5">Detail</th>
                                <th data-priority="3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer->customer_branch as $branch)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $branch->name_branch }}</td>
                                    <td>{{ $branch->type_branch }}</td>
                                    <td>{{ $branch->pic_branch }}</td>
                                    <td>{{ $branch->desc_branch }}</td>
                                    <td>
                                        @can('edit-brancher-customer')
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editBranchCustomer-{{ $branch->id }}">
                                            <span class="ms-1">Edit</span>
                                        </button>
                        
                                        <!-- Modal -->
                                        <form action="{{ route('customer-branch.update', $branch->id) }}" method="POST" novalidate class="needs-validation d-inline-block form-edit">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal fade" id="editBranchCustomer-{{ $branch->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Information Update</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row g-3 mb-3">
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control" id="name" name="name_branch" placeholder="Name Branch" title="Name Branch" value="{{ $branch->name_branch }}" spellcheck="false" required>
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control" id="type_branch" name="type_branch" placeholder="Type Branch" title="Type Branch" value="{{ $branch->type_branch }}" required>
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="text" class="form-control" id="pic_branch" name="pic_branch" placeholder="PIC Branch" title="PIC Branch" value="{{ $branch->pic_branch }}" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 mb-3">
                                                                <input type="text" class="form-control" id="address_branch" name="address_branch" placeholder="Address Branch" title="Address" spellcheck="false" value="{{ $branch->address_branch }}" required>
                                                            </div>

                                                            <div class="col-lg-12 mb-3">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control" placeholder="Deskripsikan pabrik / branch / Kapasitas Produksi disini" name="desc_branch" style="height: 100px" spellcheck="false" required>{{ $branch->desc_branch }}</textarea>
                                                                    <label>Description</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </form>
                                        @endcan
                                        @can('delete-brancher-customer')
                                        <form action="{{ route('customer-branch.destroy', $branch->id) }}" method="POST" class="needs-validation d-inline-block form-destroy">
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
        {{-- End Table View --}}

    </div>
@endsection