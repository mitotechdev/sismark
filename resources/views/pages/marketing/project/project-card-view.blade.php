@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Progress Kerja</h4>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span class="badge rounded-pill bg-info">On Going</span>
                        <div class="d-flex-align-items-center justify-content-between">
                            <label class="form-label">4 hour ago</label>
                            <div class="btn-group">
                                <button type="button" class="btn btn-transparant btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/project-todo-view">Task</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Print</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Mark as Done</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">PDAM Tirta Persada</h5>
                        <p class="fs-9">by <a class="fw-semibold" href="#!">Sintia Lestari</a>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-outline-primary">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span class="badge rounded-pill bg-danger">Cancelled</span>
                        <label class="form-label">2 minute ago</label>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">PDAM Bengkalis</h5>
                        <p class="fs-9">by <a class="fw-semibold" href="#!">Sintia Lestari</a>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-outline-primary">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span class="badge rounded-pill bg-danger">Cancelled</span>
                        <label class="form-label">2 minute ago</label>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">PDAM Tirta Persada</h5>
                        <p class="fs-9">by <a class="fw-semibold" href="#!">Sintia Lestari</a>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-outline-primary">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span class="badge rounded-pill bg-success">Completed</span>
                        <label class="form-label">2 hour ago</label>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">PDAM Tirta Persada</h5>
                        <p class="fs-9">by <a class="fw-semibold" href="#!">Sintia Lestari</a>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-outline-primary">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span class="badge rounded-pill bg-danger">Rejected</span>
                        <label class="form-label">2 hour ago</label>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">PT Sumatera Utara</h5>
                        <p class="fs-9">by <a class="fw-semibold" href="#!">Sintia Lestari</a>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-outline-primary">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span class="badge rounded-pill bg-danger">Rejected</span>
                        <label class="form-label">2 hour ago</label>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">PT Sumatera Utara</h5>
                        <p class="fs-9">by <a class="fw-semibold" href="#!">Sintia Lestari</a>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-outline-primary">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span class="badge rounded-pill bg-success">Completed</span>
                        <label class="form-label">6 hour ago</label>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">PT Gunbuster</h5>
                        <p class="fs-9">by <a class="fw-semibold" href="#!">Sintia Lestari</a>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-outline-primary">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection