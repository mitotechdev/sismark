@extends('components.app.layouts')
@section('content')
@push('style')
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/timeline.css') }}">
    <style>
        .table-custom {
            border-collapse: separate;
            border-spacing: 0px 6px;
        }
    </style>
@endpush
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Dashboard</h4>
        <div class="row g-3 col-reverse">
            <div class="col-md-8 order-md-1 order-sm-1 order-2">
                <div class="row g-2 mb-3">
                    <div class="col-md-4">
                        <div class="d-flex bg-white px-3 py-4 rounded-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success"><i class="bx bx-dollar-circle"></i></span>
                            </div>
                            <div class="me-2">
                                <h5 class="mb-0">{{ 'Rp  '. number_format($totalRevenue, 0, ',', '.') }}</h5>
                                <small class="text-muted">Total Sales (Paid)</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex bg-white px-3 py-4 rounded-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-store"></i></span>
                            </div>
                            <div class="me-2">
                                <h5 class="mb-0">{{ Auth::user()->customers()->count() }}</h5>
                                <small class="text-muted">Total Customers</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex bg-white px-3 py-4 rounded-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-target-lock"></i></span>
                            </div>
                            <div class="me-2">
                                <h5 class="mb-0">{{ $total_po }}</h5>
                                <small class="text-muted">Total Purchase Order</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex bg-white px-3 py-4 rounded-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-store"></i></span>
                            </div>
                            <div class="me-2">
                                @php
                                    $newCustomer = $customers->filter(function($query) {
                                        return $query->type_customer_id === 1;
                                    });
                                @endphp
                                <h5 class="mb-0">{{ $newCustomer->count() }}</h5>
                                <small class="text-muted">Total New Customer</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex bg-white px-3 py-4 rounded-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-store"></i></span>
                            </div>
                            <div class="me-2">
                                @php
                                    $customerNotYetFollowUp = $customers->filter(function($query) {
                                        return $query->type_customer_id === 2;
                                    });
                                @endphp
                                <h5 class="mb-0">{{ $customerNotYetFollowUp->count() }}</h5>
                                <small class="text-muted">Belum difollow up</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex bg-white px-3 py-4 rounded-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-store"></i></span>
                            </div>
                            <div class="me-2">
                                @php
                                    $customerNotYetFollowUp = $customers->filter(function($query) {
                                        return $query->type_customer_id === 3;
                                    });
                                @endphp
                                <h5 class="mb-0">{{ $customerNotYetFollowUp->count() }}</h5>
                                <small class="text-muted">Sudah difollow up</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex bg-white px-3 py-4 rounded-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success"><i class="bx bx-store"></i></span>
                            </div>
                            <div class="me-2">
                                @php
                                    $customerNotYetFollowUp = $customers->filter(function($query) {
                                        return $query->type_customer_id === 4;
                                    });
                                @endphp
                                <h5 class="mb-0">{{ $customerNotYetFollowUp->count() }}</h5>
                                <small class="text-muted">Customer Existing</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h5 class="text-muted mb-0">Recent Tasks</h5>
                            <a class="fw-bold nav-item" href="{{ route('project.index') }}" role="button">View All</a>
                        </div>
                        @if ($tasks->isEmpty())
                        <div class="alert alert-info text-black" role="alert">
                            Hi {{ Auth::user()->nickname }} enjoy your day! No work in progress yet 🌟
                        </div>
                        @else
                        <div>
                            <div class="table-responsive">
                                <table class="table table-borderless table-custom">
                                    <thead>
                                        <tr>
                                            <th>Act.</th>
                                            <th>Name Task</th>
                                            <th>Date</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                        <tr>
                                            <td class="bg-white rounded-start" style="width: 5%;">
                                                <form action="{{ route('task.checked', ['project' => $task->project_id, 'task' => $task->id]) }}" method="POST" class="form-update-task">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" value="{{ $task->project_id }}" name="project_id">
                                                    <input type="hidden" value="{{ $task->id }}" name="task_id">
                                                    <input class="form-check-input updated-checkbox-status" type="checkbox" attribute-project={{ $task->project_id }} attribute-task={{ $task->id }}>
                                                </form>
                                            </td>
                                            <td class="bg-white" style="width: 40%">{{$task->name_task }}</td>
                                            <td class="bg-white">{{ date('d M, Y', strtotime($task->start_date)) }}</td>
                                            <td class="bg-white">{{ date('d M, Y', strtotime($task->due_date)) }}</td>
                                            <td class="bg-white rounded-end">{{ $task->market_progress->name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row g-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">My Activity</h5>
                        <a href="{{ route('project.index') }}" class="btn btn-primary">Add Activity</a>
                    </div>
                    @forelse ($projects as $project)
                    <div class="col-md-6">
                        <div class="card rounded-3 border border-{{ $project->market_progress->tag_front_end }} shadow-none">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                {{ $project->created_at->diffForHumans() }}
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold text-{{ $project->market_progress->tag_front_end }}">{{ $project->customer->name_customer }}</h5>
                                <p class="text-muted">
                                    {{ Str::limit($project->desc_project, 70, '...') }}
                                </p>
                                <div class="text-light small fw-medium">Work Progress</div>
                                <div class="progress">
                                    @php
                                        $task_completed = $project->tasks()->where('status_task', true)->count();
                                        $total_task = $project->tasks()->count('status_task');
                                        if($total_task == 0) {
                                            $total_progress = 0;
                                        } else {
                                            $total_progress = ($task_completed/$total_task) * 100;
                                        }
                                    @endphp
                                    <div class="progress-bar bg-{{ $project->market_progress->tag_front_end }} progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ round($total_progress) }}%;">{{ round($total_progress) }}%</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-4">
                                    <a href="{{ route('project.show', $project->id) }}" class="btn btn-outline-{{ $project->market_progress->tag_front_end }} rounded-pill">See More</a>
                                    <span>{{ $project->market_progress->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-info text-black">
                        🤓 You're not have activity yet
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="col-md-4 order-md-2 order-sm-1 order-1">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card text-center">
                            <div class="card-header pb-0">
                              Profile
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="col-5 mx-auto py-3">
                                        @if (Auth::user()->image)
                                            <img src="{{ asset('storage/'. Auth::user()->image) }}" class="img-thumbnail rounded-circle border border-secondary" />
                                        @else
                                            <img src="{{ Vite::asset('resources/assets/img/avatars/avatar.png') }}" class="img-thumbnail rounded-circle border border-secondary"/>    
                                        @endif
                                    </div>
                                    <h5 class="card-title mb-0">{{ Auth::user()->full_name }}</h5>
                                    <p class="card-text mb-0">Sales & Marketing</p>
                                    <div class="row my-3">
                                        <div class="col-4">
                                            <h6 class="mb-0">{{ $prospecting }}</h6>
                                            <small class="text-primary">Prospecting</small>
                                        </div>
                                        <div class="col-4">
                                            <h6 class="mb-0">{{ $hot_prospect }}</h6>
                                            <small class="text-success">Hot Prospect</small>
                                        </div>
                                        <div class="col-4">
                                            <h6 class="mb-0">{{ $loss_prospect }}</h6>
                                            <small class="text-warning">Loss Prospect</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-4">
                                    <div id="content">
                                        <h6 class="text-start">Timeline Task</h6>
                                        <ul class="timeline">
                                            @foreach($task_done as $task)
                                            <li class="event" data-date="{{ date('d M', strtotime($task->start_date)) . ' - ' . date('d M, Y', strtotime($task->due_date)) }}">
                                                <h3>{{ $task->market_progress->name }}</h3>
                                                <small class="text-muted">{{ $task->project->project_name }}</small>
                                                <p>{{ $task->desc_task }}</p>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12 my-4 text-start">
                                    <h6>Recent Customer</h6>
                                    @forelse ($customers as $customer)
                                        <div class="col-12">
                                            <h5 class="mb-0 text-primary">{{ $customer->name_customer }}</h5>
                                            <small class="mb-0 text-muted">{{ $customer->total_employee }} Employees</small>
                                            <hr class="devider">
                                        </div>
                                        @empty
                                        <div class="alert alert-info">
                                            ✨ You don't have a customer yet
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const checkboxes = document.querySelectorAll('.updated-checkbox-status');

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                let form = checkbox.parentElement;
                let confirmed = window.confirm('Apakah anda yakin telah menyelesaikan task ini ?');
                if(confirmed) {
                    form.submit();
                } else {
                    checkbox.checked = !checkbox.checked;
                }

            });
        });
    </script>
@endpush