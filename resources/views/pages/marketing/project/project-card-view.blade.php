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
                        <label class="form-label">{{ $project->created_at->diffForHumans() }}</label>
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