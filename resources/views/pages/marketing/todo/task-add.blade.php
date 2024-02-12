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

        <div class="wrapper-new-task">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-transparant text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addNewTask">
                + Add New Task
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="addNewTask" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('task.store') }}" method="POST" class="needs-validation form-create">
                        @csrf
                        @method('POST')
                        <input type="hidden" value="{{ $project->id }}" name="project_id">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Informasi Kegiatan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="todo-name" class="form-label">Nama Kegiatan</label>
                                    <input type="text" id="todo-name" name="name_task" class="form-control" required
                                        oninvalid="this.setCustomValidity('Isikan kegiatan anda.')"
                                        oninput="setCustomValidity('')"
                                        placeholder="Enter todo">
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="date_todo" class="form-label">Tanggal Kegiatan</label>
                                    <input type="date" id="date_todo" name="start_date" class="form-control" title="Tanggal Kegiatan / Todo" required>
                                </div>
                                <div class="col mb-0">
                                    <label for="time_todo" class="form-label">Jam</label>
                                    <input type="time" id="time_todo" name="time_task" class="form-control" title="Jam Mulai" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="my-3">
                                    <label for="desc_todo" class="form-label">Deskripsi Pekerjaan</label>
                                    <textarea name="desc_task" id="desc_task" class="form-control" required></textarea>
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
        </div>

        <div class="nav-align-top my-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link"
                        href="{{ route('task.completed', $project->id) }}"
                    >
                        Completed
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-success">{{ $countTasks }}</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="navs-top-home">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-info alert-dismissible text-black" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="wrapper-list-tasks">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 55%">Task Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Act.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>
                                            <form action="{{ route('task.checked') }}" method="POST" class="form-update-task">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" value="{{ $project->id }}" name="project_id">
                                                <input type="hidden" value="{{ $task->id }}" name="task_id">
                                                <input class="form-check-input updated-checkbox-status" type="checkbox" attribute-project={{ $project->id }} attribute-task={{ $task->id }}>
                                            </form>
                                        </td>
                                        <td>{{ $task->name_task }}</td>
                                        <td>{{ date('d M, Y', strtotime($task->start_date)) }}</td>
                                        <td>{{ date('h:i, A', strtotime($task->time_task)) }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-warning"><i class='bx bxs-edit'></i></button>
                                            <button class="btn btn-sm btn-outline-danger"><i class='bx bxs-trash'></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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