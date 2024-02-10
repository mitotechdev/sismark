@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold"><span class="text-muted fw-light">My Activity</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">My Activiy</li>
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
                <button type="button" class="btn btn-transparant text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addNewActivity">
                    + Add New Activity
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="addNewActivity" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
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
                                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control" title="Tanggal Mulai" required>
                                    </div>
                                    <div class="col mb-0">
                                        <label for="due_date" class="form-label">Deadline</label>
                                        <input type="date" id="due_date" name="due_date" class="form-control" title="Deadline Kegiatan" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="my-3">
                                        <label for="desc_project" class="form-label">Deskripsi Tambahan</label>
                                        <textarea name="desc_project" id="desc_project" class="form-control" style="height: 100px;"></textarea>
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 45%">Name Customer</th>
                            <th>Assign To</th>
                            <th>Start Date</th>
                            <th>Due Date</th>
                            <th>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{-- <a class="fw-bold" href="">{{ $project->project_name }}</a> --}}
                                <div class="col-lg-12 col-md-6">
                                    <div class="wrapper">
                                      <a
                                        class="fw-bold"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasBoth{{$project->id}}"
                                        aria-controls="offcanvasBoth"
                                        href="javascript:void(0);"
                                      >
                                      {{ $project->project_name }}
                                      </a>
                                      <div
                                        class="offcanvas offcanvas-end"
                                        data-bs-scroll="true"
                                        tabindex="-1"
                                        id="offcanvasBoth{{$project->id}}"
                                        aria-labelledby="offcanvasBothLabel"
                                      >
                                        <div class="offcanvas-header">
                                          <h5 id="offcanvasBothLabel" class="offcanvas-title">Informasi Selengkapnya</h5>
                                          <button
                                            type="button"
                                            class="btn-close text-reset"
                                            data-bs-dismiss="offcanvas"
                                            aria-label="Close"
                                          ></button>
                                        </div>
                                        <div class="offcanvas-body mx-0 flex-grow-0">
                                            @if ($project->status == "Ongoing")
                                                <span class="badge rounded-pill bg-label-primary py-2 px-3 mb-2">🟣 {{ $project->status }}</span>
                                            @elseif ($project->status == "Completed")
                                                <span class="badge rounded-pill bg-label-success py-2 px-3 mb-2">🟢 {{ $project->status }}</span>
                                            @elseif ($project->status == "Inactive")
                                                <span class="badge rounded-pill bg-label-secondary py-2 px-3 mb-2">🟤 {{ $project->status }}</span>
                                            @elseif ($project->status == "Canceled")
                                                <span class="badge rounded-pill bg-label-warning py-2 px-3 mb-2">🟠 {{ $project->status }}</span>
                                            @else
                                                <span class="badge rounded-pill bg-label-danger py-2 px-3 mb-2">🔴 {{ $project->status }}</span>
                                            @endif
                                            <h2 class="mb-4">{{ $project->project_name }}</h2>
                                            <h5>Prospect Overview</h5>
                                            <p class="mb-3">
                                                {{ $project->desc_project }}
                                            </p>
                                            <div class="wrapper-date">
                                                <p class="text-muted">By <a class="fw-bold" href="javascript:void(0);">{{ $project->assign_to }}</a></p>
                                                <dl class="row mt-2">
                                                    <dt class="col-4">Start Date</dt>
                                                    <dd class="col-8">{{ date('d F, Y', strtotime($project->start_date)) }}</dd>
                            
                                                    <dt class="col-4">Due Date</dt>
                                                    <dd class="col-8">{{ date('d F, Y', strtotime($project->due_date)) }}</dd>
                                                </dl>
                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary d-grid w-100 mt-5"
                                                data-bs-dismiss="offcanvas"
                                            >Tutup</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </td>
                            <td>{{ $project->assign_to }}</td>
                            <td>{{ date('d M, Y', strtotime($project->start_date)) }}</td>
                            <td>{{ date('d M, Y', strtotime($project->due_date)) }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-transparant btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/project-todo-view">Task</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Print</a></li>
                                    <li><a class="dropdown-item" href="{{ route('project.edit', $project->id) }}">Update</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Remove</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection