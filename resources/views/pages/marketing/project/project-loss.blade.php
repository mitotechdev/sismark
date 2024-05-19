@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Loss Prospect</h4>
        <div class="card">
            <div class="card-header">
                @if ($message = Session::get('success'))
                    <div class="alert alert-info alert-dismissible text-black" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLossProject">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">New Loss Prospect</span>
                </button>
                
                <div class="modal fade" id="addLossProject" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form action="{{ route('project.loss.submit') }}" method="POST" class="needs-validation form-create">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Prospect Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12"> 
                                            <label for="project_id" class="form-label">ID Prospect</label>
                                            <select class="form-select select-box" name="project_id" id="project_id" required>
                                                <option value="" selected>Choose Prospect...</option>
                                                @foreach ($projects->whereNotIn('prospect_id', 4) as $project)
                                                    <option value="{{ $project->id }}">{{ $project->project_code . ' | ' . $project->customer->name_customer }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" name="desc" id="description" rows="10" placeholder="Why this be loss prospect..." spellcheck="false" autocomplete="off" required></textarea>
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
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name Customer</th>
                            <th>PIC</th>
                            <th>Desc</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects->whereIn('prospect_id', 4) as $project)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $project->customer->name_customer }}</td>
                                <td>{{ $project->user->nickname }}</td>
                                <td>{{ $project->desc_prospect }}</td>
                                <td>
                                    <span class="badge bg-label-danger">{{ $project->prospect->name }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

