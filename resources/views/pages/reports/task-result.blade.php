@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Result Task</h4>
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <a class="btn btn-secondary me-2" href="{{ route('report.tasks') }}">Go Back</a>
                <form action="{{ route('report.print.tasks') }}" method="POST" class="needs-validation" novalidate target="__blank">
                    @csrf
                    <input type="hidden" value="{{ request()->start_date }}" name="start_date">
                    <input type="hidden" value="{{ request()->end_date }}" name="end_date">
                    <input type="hidden" value="{{ request()->status_task }}" name="status_task">
                    <button type="submit" class="btn btn-outline-primary">Print Report</button>
                </form>
                <form action="{{ route('export.tasks') }}" method="POST" class="needs-validation" novalidate target="__blank">
                    @csrf
                    <input type="hidden" value="{{ request()->start_date }}" name="start_date">
                    <input type="hidden" value="{{ request()->end_date }}" name="end_date">
                    <input type="hidden" value="{{ request()->status_task }}" name="status_task">
                    <button type="submit" class="btn btn-outline-primary ms-1">Export Tasks</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Name Task</th>
                            <th>Start Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Desc.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr style="vertical-align: baseline">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->project->customer->name_customer }}</td>
                                <td class="w-25">{{ $task->name_task }}</td>
                                <td class="text-nowrap">{{ date('d M, Y', strtotime($task->start_date)) }}</td>
                                <td class="text-nowrap">{{ date('d M, Y', strtotime($task->due_date)) }}</td>
                                <td>
                                    @if ($task->status_task == false)
                                        <span class="badge bg-label-primary">Progress</span> 
                                    @else
                                        <span class="badge bg-label-success">Done</span>
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

