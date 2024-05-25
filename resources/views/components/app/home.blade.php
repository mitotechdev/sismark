@extends('components.app.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        
        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- Greetings --}}
            
            <div class="row">
                <h5 class="mb-1">Hey there, {{ Auth::user()->full_name}}</h5>
                <p>Welcome back, we're happy to have you there!</p>
            </div>

            <div class="row g-3">
                <div class="col-sm-8">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="card-title mb-0">
                                        <h4 class="mb-1 text-info">Total Revenue</h4>
                                        <span class="badge bg-label-info">Year 2024</span>
                                    </div>
                                    <div class="rounded p-2 bg-label-info">
                                        <i class='bx bx-sm bxs-wallet-alt'></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h2>{{ 'Rp  '. number_format($totalRevenue, 0, ',', '.') }}</h2>
                                    <small class="text-muted">Total pendapatan cabang anda ditahun ini</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="card-title mb-0">
                                        <h4 class="text-warning mb-1">Total Outstanding</h4>
                                        <span class="badge bg-label-warning">Year 2024</span>
                                    </div>
                                    <div class="rounded p-2 bg-label-warning">
                                        <i class='bx bx-sm bxs-wallet-alt'></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h2>{{ 'Rp  '. number_format($totalOutstanding, 0, ',', '.') }}</h2>
                                    <small class="text-muted">Total piutang customer anda ditahun ini</small>
                                </div>
                            </div>
                        </div>
                         {{-- Chart Monthly Revenue --}}
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    {!! $monthlyRevenueChart->container() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title m-0 me-2">Progress List</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless w-100">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Activity</th>
                                                    <th>Date</th>
                                                    <th>Progress</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 13px;">
                                                @forelse ($tasks as $task)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if ($task->user->image)
                                                                <img src="{{ asset('storage/'. $task->user->image) }}" class="w-px-40 h-auto rounded-circle" />
                                                            @else
                                                                <img src="{{ Vite::asset('resources/assets/img/avatars/avatar.png') }}" class="w-px-40 h-auto rounded-circle"/>    
                                                            @endif
                                                            <span>{{ $task->user->nickname }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $task->name_task }}</td>
                                                    <td class="text-nowrap">{{ date('d/m/Y', strtotime($task->start_date)) }}</td>
                                                    <td>{{ $task->market_progress->name }}</td>
                                                    <td>
                                                        @if ($task->status_task == 0)
                                                            <span class="badge bg-label-warning">Progress</span>
                                                        @else
                                                            <span class="badge bg-label-primary">Done</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                <div class="alert alert-info">Data masih kosong</div>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0 me-2">Latest Transactions</h5>
                        </div>
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                @forelse ($salesOrders as $order)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        @if ($order->sales->image)
                                            <img src="{{ asset('storage/'. $order->sales->image) }}" class="w-px-40 h-auto rounded-circle" />
                                        @else
                                            <img src="{{ Vite::asset('resources/assets/img/avatars/avatar.png') }}" class="w-px-40 h-auto rounded-circle"/>    
                                        @endif
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">{{ $order->sales->nickname }}</small>
                                            <h6 class="mb-0">{{ $order->so_number }}</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">
                                                @php
                                                    $total = $order->sales_order_items->sum('total_amount');
                                                    $ppn = $total * $order->tax->tax_value;
                                                    $grandTotal = $total + $ppn;
                                                @endphp
                                                {{ AbbreviateNumber::abbreviate($grandTotal) }}    
                                            </h6> <span class="text-muted">IDR</span>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                <div class="alert alert-info">Data masih kosong</div>
                                @endforelse
                                {{-- <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ Vite::asset('resources/assets/img/avatars/avatar.png') }}" class="w-px-40 h-auto rounded-circle"/>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">Yudha Satria</small>
                                            <h6 class="mb-0">PO/SKXX/2033/23X</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">+82.6</h6> <span class="text-muted">USD</span>
                                        </div>
                                    </div>
                                </li>

                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ Vite::asset('resources/assets/img/avatars/avatar.png') }}" class="w-px-40 h-auto rounded-circle"/>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">Yudha Satria</small>
                                            <h6 class="mb-0">PO/SKXX/2033/23X</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">+82.6</h6> <span class="text-muted">USD</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ Vite::asset('resources/assets/img/avatars/avatar.png') }}" class="w-px-40 h-auto rounded-circle"/>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">Yudha Satria</small>
                                            <h6 class="mb-0">PO/SKXX/2033/23X</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">+82.6</h6> <span class="text-muted">USD</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ Vite::asset('resources/assets/img/avatars/avatar.png') }}" class="w-px-40 h-auto rounded-circle"/>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">Yudha Satria</small>
                                            <h6 class="mb-0">PO/SKXX/2033/23X</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">+82.6</h6> <span class="text-muted">USD</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ Vite::asset('resources/assets/img/avatars/avatar.png') }}" class="w-px-40 h-auto rounded-circle"/>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">Yudha Satria</small>
                                            <h6 class="mb-0">PO/SKXX/2033/23X</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">+82.6</h6> <span class="text-muted">USD</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ Vite::asset('resources/assets/img/avatars/avatar.png') }}" class="w-px-40 h-auto rounded-circle"/>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">Yudha Satria</small>
                                            <h6 class="mb-0">PO/SKXX/2033/23X</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">+82.6</h6> <span class="text-muted">USD</span>
                                        </div>
                                    </div>
                                </li> --}}
                            
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ $monthlyRevenueChart->cdn() }}"></script>
    {{ $monthlyRevenueChart->script() }}
@endsection
