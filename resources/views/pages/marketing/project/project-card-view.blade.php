@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Progress Kerja</h4>
        <div class="row g-3">
            @foreach ($projects as $project)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span class="badge bg-label-{{$project->prospect->tag_front_end}}">{{ $project->prospect->name }}</span>
                        <label class="form-label mb-0">{{ $project->created_at->diffForHumans() }}</label>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->customer->name_customer }}</h5>
                        <p class="fs-9">by <a class="fw-semibold" href="#!">{{ $project->user->full_name }}</a>
                        <p class="card-text">
                            {{ Str::limit($project->desc_project, 100, '...') }}
                        </p>
                        <a href="{{ route('project.show', $project->id) }}" class="btn btn-outline-primary">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection