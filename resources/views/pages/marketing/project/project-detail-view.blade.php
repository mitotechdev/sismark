@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Detail Kerja</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('project.index') }}">My Activity</a>
                </li>
                <li class="breadcrumb-item active">Information</li>
            </ol>
        </nav>

        <div class="card p-sm-4">
            <div class="card-header">
                <h2>{{ $project->customer->name_customer }}</h2>
                <span class="badge rounded-pill bg-label-{{ $project->prospect->tag_front_end }} py-2 px-3 mb-2">{{ $project->prospect->name }}</span>
                <span class="badge rounded-pill bg-label-{{ $project->market_progress->tag_front_end }} py-2 px-3 mb-2">{{ $project->market_progress->name }}</span>
            </div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-md-5">
                        <div class="row g-3">
                            <div class="col-12 project-overview">
                                <h5>Deskripsi Pekerjaan</h5>
                                <p>{{ $project->desc_project }}</p>
                            </div>
                            <div class="col-12 my-2">
                                <dl class="row mt-2">
                                    <dt class="col-4">Start Date</dt>
                                    <dd class="col-8">{{ date('d F, Y', strtotime($project->start_date)) }}</dd>
            
                                    <dt class="col-4">Due Date</dt>
                                    <dd class="col-8">{{ date('d F, Y', strtotime($project->due_date)) }}</dd>
                                </dl>
                            </div>
                            <div class="col-12">
                                {!! $progressChart->container() !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 recent-activity">
                        {{-- History kegiatan yang sedang berlangsung --}}
                        <h5>Kegiatan Terakhir</h5>
                        <div class="timeline-vertical timeline-with-details">
                        @foreach ($project->tasks()->where('status_task', true)->latest()->get() as $task)
                            <div class="timeline-item position-relative">
                                <div class="row g-md-3">
                                    <div class="col-12 col-md-auto d-flex">
                                        <div class="timeline-item-date order-1 order-md-0 me-md-4">
                                            <p class="fs-10 fw-semibold text-body-tertiary text-opacity-85 text-end">{{ date('d M, Y', strtotime($task->due_date)) }}<br class="d-none d-md-block"><span class="badge bg-label-success">Done</span></p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="timeline-item-content ps-6 ps-md-3">
                                            <h5 class="fs-9 lh-sm">{{ $task->name_task }}</h5>
                                            <p class="fs-9">by <a class="fw-semibold" href="#!">{{ $project->user->full_name }}</a>
                                            </p>
                                            <p class="fs-9 text-body-secondary mb-5">{{ $task->desc_task }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            {{-- <div class="timeline-item position-relative"> --}}
                                <a href="#" class="nav-link fw-bold" role="button" aria-pressed="true">>> Lihat Selengkapnya</a>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ $progressChart->cdn() }}"></script>
    {{ $progressChart->script() }}
@endpush
