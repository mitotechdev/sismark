@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Detail Kerja</h4>
        <div class="card">
            <div class="card-body">
                <h2>Agung Bumi Lestari</h2>
                <span class="badge rounded-pill bg-label-info">Progress</span>

                <div class="row g-3 mt-3">
                    <div class="col-md-4 project-overview">
                        {{-- Deskripsi dari project / Kegiataan / Prospek --}}
                        <h5>Deskripsi Pekerjaan</h5>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum, esse sit nam tenetur reiciendis
                            numquam at saepe perferendis quae porro cumque tempore deleniti adipisci, eaque laudantium
                            quibusdam unde omnis eos non quo consectetur! Perspiciatis, optio! At ex nostrum totam non
                            soluta eos beatae. Iure quo, nisi sit iusto alias aut ipsam voluptates maxime ullam sapiente?
                            Expedita, </p>
                    </div>

                    <div class="col-md-7 recent-activity">
                        {{-- History kegiatan yang sedang berlangsung --}}
                        <h5>Kegiatan Terakhir</h5>
                        <div class="timeline-vertical timeline-with-details">
                            <div class="timeline-item position-relative">
                                <div class="row g-md-3">
                                    <div class="col-12 col-md-auto d-flex">
                                        <div class="timeline-item-date order-1 order-md-0 me-md-4">
                                            <p class="fs-10 fw-semibold text-body-tertiary text-opacity-85 text-end">01 DEC,
                                                2023<br class="d-none d-md-block"> 10:30 AM</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="timeline-item-content ps-6 ps-md-3">
                                            <h5 class="fs-9 lh-sm">Follow up terus terkait penawaran</h5>
                                            <p class="fs-9">by <a class="fw-semibold" href="#!">Sintia Lestari</a>
                                            </p>
                                            <p class="fs-9 text-body-secondary mb-5">Discover limitless creativity with the
                                                Phoenix template! Our latest update offers an array of innovative features
                                                and design options.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item position-relative">
                                <div class="row g-md-3">
                                    <div class="col-12 col-md-auto d-flex">
                                        <div class="timeline-item-date order-1 order-md-0 me-md-4">
                                            <p class="fs-10 fw-semibold text-body-tertiary text-opacity-85 text-end">07 DEC,
                                                2023<br class="d-none d-md-block"> 13:30 AM</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="timeline-item-content ps-6 ps-md-3">
                                            <h5 class="fs-9 lh-sm">Kunjungan langsung ke lokasi dan mendapatkan info PIC dan kebutuhan</h5>
                                            <p class="fs-9">by <a class="fw-semibold" href="#!">Sintia Lestari</a>
                                            </p>
                                            <p class="fs-9 text-body-secondary mb-5">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem perferendis similique cumque neque officia, delectus vero tempora non, ratione ducimus dicta.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item position-relative">
                                <div class="row g-md-3">
                                    <div class="col-12 col-md-auto d-flex">
                                        <div class="timeline-item-date order-1 order-md-0 me-md-4">
                                            <p class="fs-10 fw-semibold text-body-tertiary text-opacity-85 text-end">08 DEC,
                                                2023<br class="d-none d-md-block"> 13:30 AM</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="timeline-item-content ps-6 ps-md-3">
                                            <h5 class="fs-9 lh-sm">Follow up terkait penawaran</h5>
                                            <p class="fs-9">by <a class="fw-semibold" href="#!">Sintia Lestari</a>
                                            </p>
                                            <p class="fs-9 text-body-secondary mb-5">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem perferendis similique cumque neque officia, delectus vero tempora non, ratione ducimus dicta.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="timeline-item position-relative"> --}}
                                <a href="#" class="nav-link fw-bold" role="button" aria-pressed="true">>> Lihat Selengkapnya</a>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
