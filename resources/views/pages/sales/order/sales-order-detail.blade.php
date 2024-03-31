@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Order Detail</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('sales-order.index') }}">Sales Order</a>
                </li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header text-center">
                <h4>Purchase Order Information</h4>
            </div>
            <div class="card-body mx-md-4">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <h5 class="fw-bold">Customer</h5>
                        <div class="1h-sm">{{ $salesOrder->customer->name_customer }}</div>
                        <div class="1h-sm">{{ $salesOrder->customer->address_customer }}</div>
                        <div class="1h-sm">{{ $salesOrder->customer->city }}</div>
                        <div class="1h-sm">{{ $salesOrder->customer->country }}</div>
                        <div class="1h-sm">{{ $salesOrder->customer->phone_a }}</div>
                        <div class="1h-sm">{{ $salesOrder->customer->email_a }}</div>
                        {{-- <p></p> --}}
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <h5 class="fw-bold">Delivery Address</h5>
                        <div class="1h-sm">{{ $salesOrder->ship_to }}</div>
                        {{-- <div class="1h-sm">{{ $salesOrder->so_number }}</div>
                        <div class="1h-sm">{{ date('d M, Y', strtotime($salesOrder->order_date)) }}</div>
                        <div class="1h-sm">
                            TOP 
                            {{ now()->diffInDays($salesOrder->term) }} Day remaining    
                        </div> --}}
                    </div>
                </div>
                <div class="row g-3 my-3">
                    <div class="table-responsive">
                        <table class="text-nowrap w-100">
                            <thead style="text-transform: uppercase; background-color: #efefef;">
                                <tr>
                                    <th class="p-2">Order In</th>
                                    <th class="p-2">Term Of Payment</th>
                                    <th class="p-2">Created By</th>
                                    <th class="p-2">Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-2">{{ date('d M, Y', strtotime($salesOrder->order_date)) }}</td>
                                    <td class="p-2">{{ now()->diffInDays($salesOrder->term) }} Day remaining</td>
                                    <td class="p-2">{{ $salesOrder->created_by }}</td>
                                    <td class="p-2">Purchasing</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row g-3 my-3">
                    <table class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Description</th>
                                <th>QTY</th>
                                <th>Item Price</th>
                                <th>Disc.</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesOrder->sales_order_items as $item)
                                <tr>
                                    <td>{{ $item->product->code }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ 'Rp  '. number_format($item->price, 2, ',', '.') }}</td>
                                    <td>{{ 'Rp  '. number_format($item->discount, 2, ',', '.') }}</td>
                                    <td>{{ 'Rp  '. number_format($item->total_amount, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection