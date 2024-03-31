@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold"><span class="text-muted fw-light">My Activity</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">My Activity</li>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewActivity">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">Add Data</span>
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="addNewActivity" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form action="{{ route('project.store') }}" method="POST" class="needs-validation form-create">
                            @csrf
                            @method('POST')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Informasi Kegiatan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="project_name" class="form-label">Name Customer</label>
                                        <input type="text" id="project_name" name="project_name" class="form-control"
                                            oninvalid="this.setCustomValidity('Isikan nama customer / prospek anda.')"
                                            title="Nama customer / prospek anda"
                                            placeholder="Enter name customer" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="assign_to" class="form-label">Assign To</label>
                                        <select class="form-select" name="assign_to" id="assign_to" required
                                            title="Ditugaskan Kepada"
                                        >
                                            <option value="" selected>Choose Member...</option>
                                            <option value="Sintia Lestari">Sintia Lestari</option>
                                            <option value="MITO">MITO</option>
                                            <option value="Yudha Satria">Yudha Satria</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label for="start_date" class="form-label">Date Start</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control" title="Tanggal Mulai" required>
                                    </div>
                                    <div class="col mb-0">
                                        <label for="due_date" class="form-label">Due Date</label>
                                        <input type="date" id="due_date" name="due_date" class="form-control" title="Deadline Kegiatan" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="my-3">
                                        <label for="desc_project" class="form-label">Additional Decs</label>
                                        <textarea name="desc_project" id="desc_project" class="form-control" rows="10" placeholder="Tambahkan deskripsi untuk aktivitas anda. Kosongkan dengan (-) untuk mengabaikan bagian ini"></textarea>
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
                        {{-- @foreach ($prospectHots as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->project_code }}</td>
                                <td>{{ $item->project_name }}</td>
                                <td>{{ $item->assign_to }}</td>
                                <td>
                                    @if ($item->prospect_status == 1)
                                        <span class="badge bg-label-success">Hot Prospect</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection