@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold"><span class="text-muted fw-light">Task</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('project.index') }}">My Activity</a>
                </li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>

        
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('task.project', $project->id) }}">Progress</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page">Completed <span class="bg-label-success">( {{ $tasksCompleted->count() }} )</span></a>
            </li>
        </ul>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th data-priority="1">#</th>
                            <th data-priority="2">Task Name</th>
                            <th data-priority="4">Date</th>
                            <th data-priority="5">Time</th>
                            <th data-priority="6">Status</th>
                            <th data-priority="7">Desc</th>
                            <th data-priority="3">Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasksCompleted as $task)
                            <tr>
                                <td><input class="form-check-input" type="checkbox" checked="{{ $task->status_task }}" readonly disabled></td>
                                <td>{{ $task->name_task }}</td>
                                <td class="text-nowrap">{{ date('d M, Y', strtotime($task->start_date)) }}</td>
                                <td class="text-nowrap">{{ date('h:i, A', strtotime($task->time_task)) }}</td>
                                <td>{{ $task->market_progress->name }}</td>
                                <td style="width:35%">{{ $task->desc_task }}</td>
                                <td>
                                    Completed
                                </td>
                                
                            </tr>

                        @endforeach
                    </tbody>
                </table>
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