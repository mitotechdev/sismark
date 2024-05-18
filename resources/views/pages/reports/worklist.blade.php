@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Worklists</h4>
        <div class="card">
            <div class="card-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Name Customer</th>
                            <th>PIC</th>
                            <th>Type Progress</th>
                            <th>Status</th>
                            <th>Desc</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d M, Y', strtotime($task->start_date)) }}</td>
                                <td>{{ date('d M, Y', strtotime($task->due_date)) }}</td>
                                <td>{{ $task->customer->name_customer }}</td>
                                <td>{{ $task->user->nickname }}</td>
                                <td>{{ $task->market_progress->name }}</td>
                                <td>
                                    @if ($task->status_task == 0)
                                        <span class="badge bg-label-warning">Progress</span>
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

