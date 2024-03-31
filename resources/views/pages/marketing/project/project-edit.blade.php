@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold"><span class="text-muted fw-light">Formulir Update</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('project.index') }}">My Activity</a>
                </li>
                <li class="breadcrumb-item active">Update</li>
            </ol>
        </nav>
        <form action="{{ route('project.update', $project->id) }}" method="POST" class="needs-validation form-edit">
                @csrf
                @method('PUT')
                <div class="card col-md-7">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Form Edit</h4>
                        <small class="rounded-pill bg-label-secondary px-3 py-1">Dibuat oleh <strong>{{ $project->created_by }}</strong></small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3">
                                <label for="project_name" class="form-label">Name Customer</label>
                                <input type="text" id="project_name" name="project_name" class="form-control"
                                    oninvalid="this.setCustomValidity('Isikan nama customer / prospek anda.')"
                                    title="Nama customer / prospek anda"
                                    placeholder="Enter name customer"
                                    required
                                    value="{{ $project->project_name }}"
                                    >
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="assign_to" class="form-label">Assign To</label>
                                <select class="form-select" name="assign_to" id="assign_to"
                                    required
                                    title="Ditugaskan Kepada"
                                >
                                    <option value="Sintia Lestari" {{ $project->assign_to == "Sintia Letari" ? "selected" : "" }}>Sintia Lestari</option>
                                    <option value="MITO" {{ $project->assign_to == "MITO" ? "selected" : "" }}>MITO</option>
                                    <option value="Yudha Satria" {{ $project->assign_to == "Yudha Satria" ? "selected" : "" }}>Yudha Satria</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    title="Tanggal Mulai"
                                    value="{{ $project->start_date }}"
                                    required>
                            </div>
                            <div class="col mb-0">
                                <label for="due_date" class="form-label">Deadline</label>
                                <input type="date" id="due_date" name="due_date" class="form-control"
                                    title="Deadline Kegiatan"
                                    value="{{ $project->due_date }}"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-3">
                                <label for="desc_project" class="form-label">Deskripsi Tambahan</label>
                                <textarea name="desc_project" id="desc_project" class="form-control" style="height: 170px;">{{ $project->desc_project }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                    </div>
                </div>
        </form>
    </div>
@endsection