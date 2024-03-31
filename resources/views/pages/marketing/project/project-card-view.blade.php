@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Progress Kerja</h4>
        <div class="row g-3">
            @foreach ($projects as $project)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        {{-- <span class="badge rounded-pill bg-success">{{ $project->status }}</span> --}}
                        <div class="status">
                            @if ($project->prospect_status == 0)
                                <span class="badge bg-label-warning">Draf</span>
                            @elseif ($project->prospect_status == 1)
                                <span class="badge bg-label-primary">Prospect</span>
                            @elseif ($project->prospect_status == 2)
                                <span class="badge bg-label-success">Hot Prospect</span>
                            @elseif ($project->prospect_status == 3)
                                <span class="badge bg-label-danger">Loss Prospect</span>
                            @else
                                <span class="badge bg-label-secondary">Void/Issue</span>
                            @endif
                        </div>
                        <div class="detail-card d-flex align-items-center">
                            <label class="form-label mb-0">{{ $project->created_at->diffForHumans() }}</label>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-transparant btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="">Mark as Hot Prospect</a></li>
                                    <li><a class="dropdown-item" href="">Mark as Loss Prospect</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->project_name }}</h5>
                        <p class="fs-9">by <a class="fw-semibold" href="#!">{{ $project->assign_to }}</a>
                        <p class="card-text">
                            {{ Str::limit($project->desc_project, 100, '...') }}
                        </p>
                        <a href="{{ route('project.detail', $project->id) }}" class="btn btn-outline-primary">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection