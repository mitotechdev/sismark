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
        
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-transparant text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#addNewTask">
                    + Add New Task
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="addNewTask" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="" method="POST" class="needs-validation form-create">
                            @csrf
                            @method('POST')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Informasi Kegiatan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="todo-name" class="form-label">Nama Kegiatan</label>
                                        <input type="text" id="todo-name" name="todo_name" class="form-control"
                                            oninvalid="this.setCustomValidity('Isikan kegiatan anda.')"
                                            placeholder="Enter todo" required>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label for="date_todo" class="form-label">Tanggal Kegiatan</label>
                                        <input type="date" id="date_todo" name="date_todo" class="form-control" title="Tanggal Kegiatan / Todo" required>
                                    </div>
                                    <div class="col mb-0">
                                        <label for="time_todo" class="form-label">Jam</label>
                                        <input type="time" id="time_todo" name="time_todo" class="form-control" title="Jam Mulai" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="my-3">
                                        <label for="desc_todo" class="form-label">Deskripsi Pekerjaan</label>
                                        <textarea name="desc_todo" id="desc_todo" class="form-control"></textarea>
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
            <div class="card-body">
                <div class="wrapper-list-tasks">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Act.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{-- <input class="form-check-input" type="checkbox"> --}}
                                    <input class="form-check-input updated-checkbox-status" type="checkbox">
                                </td>
                                <td style="width: 55%">
                                    <a href="">Kunjungan langsung ke lokasi</a>
                                </td>
                                <td>
                                    01 DES, 2024
                                </td>
                                <td>
                                    12:00 PM
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{-- <input class="form-check-input" type="checkbox"> --}}
                                    <input class="form-check-input updated-checkbox-status" type="checkbox">
                                </td>

                                <td style="width: 55%">
                                    <a href="">Mengantarkan invoice tagihan</a>
                                </td>
                                <td>
                                    01 DES, 2024
                                </td>
                                <td>
                                    12:00 PM
                                <td>
                                    <button class="btn btn-sm btn-outline-warning">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                let confirmed = window.confirm('Apakah anda yakin telah menyelesaikan task ini ?');
                if(confirmed) {
                    updateDataStatus(checkbox);
                } else {
                    checkbox.checked = !checkbox.checked;
                }

            });
        });

        function updateDataStatus(item) {
            let setStatus = item.checked;
            console.log(setStatus);
        }

        // function triggerCheckbox(paramA)
        // {
        //     console.log(paramA);
        // }
    </script>
@endpush