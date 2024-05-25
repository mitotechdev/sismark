@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Menu Activity</h4>
        <div class="card">
            <div class="card-header">
                <h5>Activities</h5>
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
                @can('create-project')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewActivity">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">Add Activity</span>
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="addNewActivity" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form action="{{ route('project.store') }}" method="POST" class="needs-validation form-create">
                            @csrf
                            @method('POST')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Information Activity</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="row">
                                    <div class="mb-3"> 
                                        <label for="customer" class="form-label">Name Customer</label>
                                        <select class="form-select select-box" name="customer_id" id="customer_id" required>
                                            <option value="" selected>Choose Customer...</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ '['.$customer->type_customer->name.'] '. $customer->name_customer }}</option>
                                            @endforeach
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
                                        <textarea name="desc_project" id="desc_project" class="form-control" rows="10" placeholder="Tambahkan deskripsi untuk aktivitas anda. Kosongkan dengan (-) untuk mengabaikan bagian ini" spellcheck="false"></textarea>
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
                <table class="table table-bordered datatable" style="font-size: 14px">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Code</th>
                            <th data-priority="1">Customer</th>
                            <th>Assign To</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $project->project_code }}</td>
                            <td>
                                <div class="col-lg-12 col-md-6">
                                    <div class="wrapper">
                                      <a
                                        class="fw-bold"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasBoth{{ $project->id }}"
                                        aria-controls="offcanvasBoth"
                                        href="javascript:void(0);"
                                      >
                                      {{ $project->customer->name_customer }}
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
                                            <span class="badge rounded-pill bg-label-{{ $project->prospect->tag_front_end }} py-2 px-3 mb-2">{{ $project->prospect->name }}</span>
                                            <h3 class="mb-4">{{ $project->customer->name_customer }}</h3>
                                            <h5>Overview</h5>
                                            <p class="mb-3">
                                                {{ $project->desc_project }}
                                            </p>
                                            <div class="wrapper-date">
                                                <p class="text-muted">By <a class="fw-bold" href="javascript:void(0);">{{ $project->user->full_name }}</a></p>
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
                            <td>{{ $project->user->nickname }}</td>
                            <td>
                                <span class="badge bg-label-{{$project->prospect->tag_front_end}}">{{ $project->prospect->name }}</span>
                                
                            </td>
                            <td>
                                <span class="badge bg-label-{{$project->market_progress->tag_front_end}}">{{ $project->market_progress->name }}</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-transparant btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('project.task', $project->id) }}">Task</a></li>
                                        <li><a class="dropdown-item" href="{{ route('project.show', $project->id) }}">See More</a></li>
                                        
                                        @if (Auth::user()->id == $project->user_id || Auth::user()->hasRole('Super Admin'))
                                            @can('edit-project')
                                                <li><a class="dropdown-item" href="{{ route('project.edit', $project->id) }}">Update</a></li>
                                            @endcan
                                        @endif
                                        
                                        @can('delete-project')
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Remove</a></li>
                                        @endcan
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