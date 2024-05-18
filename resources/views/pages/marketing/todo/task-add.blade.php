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
                <a class="nav-link active" aria-current="page" >Progress</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('task.completed', $project->id) }}">Completed <span class="bg-label-success">({{ $countTasks }})</span></a>
            </li>
        </ul>

        <div class="card" style="border-top-left-radius: 0">
            <div class="card-header">
                @if ($message = Session::get('success'))
                    <div class="alert alert-info alert-dismissible text-black" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- Alert Errors --}}
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible text-black" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
                <div class="d-sm-flex align-items-center justify-content-between">
                    <!-- Button trigger modal -->
                    @if (Auth::user()->can('create-task') && Auth::user()->id == $project->user_id)
                    <button type="button" class="btn btn-primary mb-sm-0 mb-2" data-bs-toggle="modal" data-bs-target="#addNewTask">
                        <i class='bx bxs-plus-circle'></i>
                        <span class="ms-1">Add Activity</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addNewTask" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <form action="{{ route('task.store') }}" method="POST" class="needs-validation form-create">
                                @csrf
                                @method('POST')
                                <input type="hidden" value="{{ $project->customer_id }}" name="customer_id">
                                <input type="hidden" value="{{ $project->id }}" name="project_id">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Information Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="todo-name" class="form-label">Name Task</label>
                                            <input type="text" id="todo-name" name="name_task" class="form-control" autocomplete="off" spellcheck="false" required>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col mb-0">
                                            <label for="date_todo" class="form-label">Date Task</label>
                                            <input type="date" id="date_todo" name="start_date" class="form-control" title="Start Date Task" required>
                                        </div>
                                        <div class="col mb-0">
                                            <label for="due_date" class="form-label">Due Date</label>
                                            <input type="date" id="due_date" name="due_date" class="form-control" title="Due Date" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 my-3">
                                            <label for="market-progress" class="form-label">Market Progress</label>
                                            <select name="market_progress" id="market-progress" class="form-select" title="Market Progress" required>
                                                <option value="" selected>Choose progress</option>
                                                @foreach ($marketProgresses->skip(1) as $progress)
                                                    <option value="{{ $progress->id }}">{{ $progress->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 my-3">
                                            <label for="desc_todo" class="form-label">Description Task</label>
                                            <textarea name="desc_task" id="desc_task" class="form-control" rows="10" placeholder="Masukan deskripsi pekerjaan anda. Kosongkan dengan strip (-) jika mengabaikan bagian ini" required></textarea>
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
                    @endif
                    <h4 class="text-muted mb-0">{{ $project->project_name }}</h4>
                </div>
            </div>
            <div class="card-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 45%">Task Name</th>
                            <th>Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>
                                    @if (Auth::user()->id == $project->user_id)
                                    <form action="{{ route('task.checked', ['project' => $project->id, 'task' => $task->id]) }}" method="POST" class="form-update-task">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" value="{{ $project->id }}" name="project_id">
                                        <input type="hidden" value="{{ $task->id }}" name="task_id">
                                        <input class="form-check-input updated-checkbox-status" type="checkbox" attribute-project={{ $project->id }} attribute-task={{ $task->id }}>
                                    </form>
                                    @endif
                                </td>
                                <td>{{ $task->name_task }}</td>
                                <td>{{ date('d M, Y', strtotime($task->start_date)) }}</td>
                                <td>{{ date('d M, Y', strtotime($task->due_date)) }}</td>
                                <td>{{ $task->market_progress->name }}</td>
                                <td>
                                    @if (Auth::user()->id == $project->user_id || Auth::user()->hasRole('Super Admin'))
                                        @can('edit-task')
                                            <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#updateTask-{{$task->id}}">
                                                <i class='bx bxs-edit'></i>
                                            </button>

                                            
                                            <div class="modal fade" id="updateTask-{{$task->id}}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <form action="{{ route('task.update', $task->id) }}" method="POST" class="needs-validation form-create">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Information Update</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="todo-name" class="form-label">Name Task</label>
                                                                    <input type="text" id="todo-name" name="name_task" class="form-control" required
                                                                        oninvalid="this.setCustomValidity('Isikan kegiatan anda.')"
                                                                        oninput="setCustomValidity('')"
                                                                        placeholder="Enter todo"
                                                                        value="{{ $task->name_task }}"
                                                                        >
                                                                </div>
                                                            </div>
                                                            <div class="row g-2">
                                                                <div class="col mb-0">
                                                                    <label for="date_todo" class="form-label">Date Task</label>
                                                                    <input type="date" id="date_todo" name="start_date" class="form-control" title="Tanggal Kegiatan / Todo" value="{{ $task->start_date }}" required>
                                                                </div>
                                                                <div class="col mb-0">
                                                                    <label for="due_date" class="form-label">Time</label>
                                                                    <input type="date" id="due_date" name="due_date" class="form-control" title="Due Date Task" value="{{ $task->due_date }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 my-3">
                                                                    <label for="market-progress" class="form-label">Market Progress</label>
                                                                    <select name="market_progress" id="market-progress" class="form-select" title="Market Progress" required>
                                                                        <option value="" selected>Choose progress</option>
                                                                        @foreach ($marketProgresses->skip(1) as $progress)
                                                                            <option value="{{ $progress->id }}" {{ $progress->id == $task->market_progress_id ? "selected" : "" }}>{{ $progress->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-12 my-3">
                                                                    <label for="desc_todo" class="form-label">Description Task</label>
                                                                    <textarea name="desc_task" id="desc_task" class="form-control" rows="10" placeholder="Masukan deskripsi pekerjaan anda. Kosongkan dengan strip (-) jika mengabaikan bagian ini" required>{{ $task->desc_task }}</textarea>
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
                                        
                                        @can('delete-task')
                                            <form action="{{ route('task.destroy', $task->id) }}" method="POST" class="needs-validation form-destroy d-inline-flex">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class='bx bxs-trash'></i></button>
                                            </form>
                                        @endcan
                                    @endif
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