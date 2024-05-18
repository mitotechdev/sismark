@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">My Tasks</h4>
        <div class="card">
            <div class="card-header">
                <form action="{{ route('report.result.tasks') }}" class="needs-validation" id="form">
                    <div class="form-text">Cari berdasarkan tanggal mulai</div>
                    <div class="row g-3">
                        
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}" required>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}" required>
                        </div>
                        <div class="col-md-3">
                            <select name="status_task" class="form-select" required>
                                <option value="" selected>Choose Status</option>
                                <option value="0">Progress</option>
                                <option value="1">Done</option>
                                <option value="2">All</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-outline-primary" id="search">Search</button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table datatable" style="font-size: 13px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Name Task</th>
                            <th class="text-nowrap">Start Date</th>
                            <th>Due Date</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th>Desc.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->project->customer->name_customer }}</td>
                                <td>{{ $task->name_task }}</td>
                                <td class="text-nowrap">{{ date('d M, Y', strtotime($task->start_date)) }}</td>
                                <td class="text-nowrap">{{ date('d M, Y', strtotime($task->due_date)) }}</td>
                                <td>{{ $task->market_progress->name }}</td>
                                <td>
                                    @if ($task->status_task == false)
                                        Progress
                                    @else
                                        Done
                                    @endif
                                </td>
                                <td>{{ $task->desc_task }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

