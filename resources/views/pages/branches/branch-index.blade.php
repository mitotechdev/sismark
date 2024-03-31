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
                        <form action="" method="POST" class="needs-validation form-create">
                            @csrf
                            @method('POST')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <label for="code_branch" class="form-label">Code Branch</label>
                                        <input type="text" id="code_branch" name="code_branch" class="form-control"
                                            oninvalid="this.setCustomValidity('Isikan kode branch')"
                                            
                                            title="Kode branch"
                                            placeholder="PKU" required>
                                    </div>
                                    <div class="col">
                                        <label for="name_branch" class="form-label">Name Branch</label>
                                        <input type="text" id="name_branch" name="name_branch" class="form-control"
                                            onchange="this.setCustomValidity(validity.valueMissing ? 'Isikan nama branch' : '');"
                                            title="Nama Branch"
                                            placeholder="Head Office Pekanbaru" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="npwp" class="form-label">NPWP</label>
                                        <input type="text" id="npwp" name="npwp" class="form-control"
                                        onchange="this.setCustomValidity(validity.valueMissing ? 'Isikan NPWP' : '');"
                                            title="Nama Branch"
                                            placeholder="Head Office Pekanbaru" required>
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
                <table class="table table-bordered" style="font-size: 14px">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Code</th>
                            <th data-priority="1">Name Customer</th>
                            <th>Assign To</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Act.</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection