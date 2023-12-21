@extends('components.app.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-3 mb-3">
                <div class="col-lg-4 order-0">
                    <div class="row gx-2">
                        <div class="col-12 mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-muted">Total Penjualan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="avatar flex-shrink-0">
                                            <span class="avatar-initial rounded bg-label-primary"><i
                                                    class='bx bx-wallet'></i></span>
                                        </div>
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <h4 class="ms-2 mb-0">{{ 'Rp ' . number_format($sumAllInvoice, 0, ",", "."); }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-muted">Total Sales Minggu Ini</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="avatar flex-shrink-0">
                                            <span class="avatar-initial rounded bg-label-primary"><i
                                                    class='bx bx-wallet'></i></span>
                                        </div>
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <h4 class="ms-2 mb-0">Rp 0</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-muted">Total Transaksi Bulan ini</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="avatar flex-shrink-0">
                                            <span class="avatar-initial rounded bg-label-primary"><i
                                                    class='bx bx-wallet'></i></span>
                                        </div>
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <h4 class="ms-2 mb-0">23 kali</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 order-1">
                    <div class="card">
                        <div class="card-header">
                            Grafik Penjualan
                        </div>
                        <div class="card-body">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Grafik Produk
                        </div>
                        <div class="card-body">
                            {!! $productChart->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Grafik Penjualan Marketing
                        </div>
                        <div class="card-body">
                            {!! $salesMarketingChart->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Product
                        </div>
                        <div class="card-body">
                            {!! $marketSalesBranchChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <!-- Order Statistics -->
                <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Order Statistics</h5>
                                <small class="text-muted">42.82k Total Sales</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-column align-items-center gap-1">
                                    <h2 class="mb-2">8,258</h2>
                                    <span>Total Orders</span>
                                </div>
                                <div id="orderStatisticsChart"></div>
                            </div>
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="bx bx-mobile-alt"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Electronic</h6>
                                            <small class="text-muted">Mobile, Earbuds, TV</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">82.5k</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-success"><i
                                                class="bx bx-closet"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Fashion</h6>
                                            <small class="text-muted">T-shirt, Jeans, Shoes</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">23.8k</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info"><i
                                                class="bx bx-home-alt"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Decor</h6>
                                            <small class="text-muted">Fine Art, Dining</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">849k</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-secondary"><i
                                                class="bx bx-football"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Sports</h6>
                                            <small class="text-muted">Football, Cricket Kit</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">99</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Order Statistics -->

                {{-- Market Progress Activity --}}
                <div class="col-md-6 col-lg-4 order-1 mb-4">
                    <div class="card">
                        <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 mb-2 me-2">Marketing Progress Terbaru</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('activities.index') }}">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="nav-align-top mb-4">
                                <ul class="nav nav-pills mb-4" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="btn-sm nav-link active" role="tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-pill-tab-pku"
                                            aria-controls="nav-pill-tab-pku" aria-selected="true">Pekanbaru</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="btn-sm nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-pills-tab-mdn"
                                            aria-controls="nav-pills-tab-mdn" aria-selected="false"
                                            tabindex="-1">Medan</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="btn-sm nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-pills-tab-pnk"
                                            aria-controls="nav-pills-tab-pnk" aria-selected="false"
                                            tabindex="-1">Pontianak</button>
                                    </li>
                                </ul>
                                <div class="tab-content p-0 shadow-none">
                                    <div class="tab-pane fade active show" id="nav-pill-tab-pku" role="tabpanel">
                                        <ul class="p-0 m-0">
                                            @foreach ($activityLatest as $activity)
                                            <li class="d-flex my-3">
                                                <div class="avatar flex-shrink-0 me-3 pe-none">
                                                    <span class="avatar-initial rounded bg-label-primary">
                                                        <i class='bx bx-user-circle'></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <small class="text-muted d-block mb-1">{{ $activity->user->name }}</small>
                                                        <h6 class="mb-0">{{ $activity->name_customer }}</h6>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <span class="text-muted">{{ $activity->type_action ?? 'No Action' }}</span>
                                                    </div>
                                                </div>
                                            </li>
                                            {{-- <li class="d-flex mb-4">
                                                <div class="avatar flex-shrink-0 me-3 pe-none">
                                                    <span class="avatar-initial rounded bg-label-primary">
                                                        <i class='bx bx-user-circle'></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <small class="text-muted d-block mb-1">Sintia Lestari</small>
                                                        <h6 class="mb-0">PT STC Indonesia</h6>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <span class="text-muted">Penetrasi</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4">
                                                <div class="avatar flex-shrink-0 me-3 pe-none">
                                                    <span class="avatar-initial rounded bg-label-primary">
                                                        <i class='bx bx-user-circle'></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <small class="text-muted d-block mb-1">Sintia Lestari</small>
                                                        <h6 class="mb-0">PT Ruang Tama</h6>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <span class="text-muted">Negosiasi</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4">
                                                <div class="avatar flex-shrink-0 me-3 pe-none">
                                                    <span class="avatar-initial rounded bg-label-primary pe-none">
                                                        <i class='bx bx-user-circle'></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <small class="text-muted d-block mb-1">Dwi Purwanti</small>
                                                        <h6 class="mb-0">PT Jaya Makmur</h6>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <span class="text-muted">Introduction</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4">
                                                <div class="avatar flex-shrink-0 me-3 pe-none">
                                                    <span class="avatar-initial rounded bg-label-primary">
                                                        <i class='bx bx-user-circle'></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <small class="text-muted d-block mb-1">Yudha Satria</small>
                                                        <h6 class="mb-0">PT Podomoro</h6>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <span class="text-muted">Deals PO</span>
                                                    </div>
                                                </div>
                                            </li> --}}
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="nav-pills-tab-mdn" role="tabpanel">
                                        <ul class="p-0 m-0">
                                            <li class="d-flex mb-4">
                                                <div class="avatar flex-shrink-0 me-3 pe-none">
                                                    <span class="avatar-initial rounded bg-label-primary">
                                                        <i class='bx bx-user-circle'></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <small class="text-muted d-block mb-1">Hendra</small>
                                                        <h6 class="mb-0">PT Swis Berlin</h6>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <span class="text-muted">Plantest</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4">
                                                <div class="avatar flex-shrink-0 me-3 pe-none">
                                                    <span class="avatar-initial rounded bg-label-primary">
                                                        <i class='bx bx-user-circle'></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <small class="text-muted d-block mb-1">Nita</small>
                                                        <h6 class="mb-0">PT Bumi Citra Prima</h6>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <span class="text-muted">Penetrasi</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4">
                                                <div class="avatar flex-shrink-0 me-3 pe-none">
                                                    <span class="avatar-initial rounded bg-label-primary">
                                                        <i class='bx bx-user-circle'></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <small class="text-muted d-block mb-1">Rozi</small>
                                                        <h6 class="mb-0">CV Manhanttan</h6>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <span class="text-muted">Maintenance</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4">
                                                <div class="avatar flex-shrink-0 me-3 pe-none">
                                                    <span class="avatar-initial rounded bg-label-primary pe-none">
                                                        <i class='bx bx-user-circle'></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <small class="text-muted d-block mb-1">Rozi</small>
                                                        <h6 class="mb-0">PT Abadi Cemerlang</h6>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <span class="text-muted">Mapping</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4">
                                                <div class="avatar flex-shrink-0 me-3 pe-none">
                                                    <span class="avatar-initial rounded bg-label-primary">
                                                        <i class='bx bx-user-circle'></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <small class="text-muted d-block mb-1">Nita</small>
                                                        <h6 class="mb-0">PT Bank Usaha Ma..</h6>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <span class="text-muted">Introduction</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="nav-pills-tab-pnk" role="tabpanel">
                                        <div class="alert alert-info">Data marketing masih kosong!</div>
                                        </p>
                                    </div>
                                    <!--/ Expense Overview -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-backdrop fade"></div>
                </div>

                <!-- Purchase Order In -->
                <div class="col-md-6 col-lg-4 order-2 mb-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Purchase Order In</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                    <a class="dropdown-item" href="javascript:void(0);">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class='bx bxs-cart-add' ></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">POI/PKU/23/12/001</small>
                                            <h6 class="mb-0">PT Intan Cemerlang</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">+82.6</h6>
                                            <span class="text-muted">USD</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class='bx bxs-cart-add' ></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">POI/PKU/23/12/002</small>
                                            <h6 class="mb-0">PT Podomora Land</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">+82.6</h6>
                                            <span class="text-muted">USD</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class='bx bxs-cart-add' ></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">POI/PKU/23/12/015</small>
                                            <h6 class="mb-0">PT Abadi Jaya</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">+82.6</h6>
                                            <span class="text-muted">USD</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class='bx bxs-cart-add' ></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">POI/PKU/23/12/025</small>
                                            <h6 class="mb-0">PT Indomaret</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">+82.6</h6>
                                            <span class="text-muted">USD</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class='bx bxs-cart-add' ></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">POI/PKU/23/12/041</small>
                                            <h6 class="mb-0">PT Lautan Luas, Tbk</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">+82.6</h6>
                                            <span class="text-muted">USD</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Transactions -->
            </div>

            <div class="row g-3">
                <div class="card">
                    <div class="card-header">
                        Product
                    </div>
                    <div class="card-body">
                        {!! $testChart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
    {{ $productChart->script() }}
    {{ $salesMarketingChart->script() }}
    {{ $marketSalesBranchChart->script() }}
    {{ $testChart->script() }}
@endpush
