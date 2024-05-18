<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Purchases Order</title>
    {{-- <link rel="stylesheet"  href="{{ public_path('css/report.css') }}" type="text/css"> --}}
    <link rel="stylesheet"  href="{{ public_path('css/report-quo.css') }}" type="text/css">
    
</head>
<body>
    {{-- <header class="w-100 clearfix">
        <div class="d-flex align-items-center">
            <div class="fs w-15 text-center d-flex justify-content-center">
                <img class="w-85" src="{{ public_path('img/logo/mei.png') }}">
            </div>
            <div class="fs w-70 text-center">
                <h2 class="my-0 fw-bold">PT MITO ENERGI INDONESIA</h2>
                <h3 class="my-0 fw-light">THE BEST PARTNER & SOLUTION</h3>
                <div class="fs-13">Komp. Taman Harapan Indah Blk. C No.16, Kec, Jl. Riau Gg. Harapan 2. Payung Sekaki, Kota Pekanbaru, Riau 28292</div>
                <div class="fs-13">Website: <a href="www.mitoindonesia.com">www.mitoindonesia.com</a>, Email: ptmei.official@gmail.com, Telp: (0761) 5795004</div>
            </div>
            <div class="fe w-15 text-end mt-1">
                <img src="{{ public_path('img/logo/logo_iscc_iso.png') }}" style="width: 110%">
            </div>
        </div>
    </header> --}}

    <div>
        <div>
            <h3 style="text-align: center">PURCHASE ORDER</h3>
        </div>

        {{-- <div class="row my-2 clearfix">
            <div class="col fs w-50">
                <h4 class="text-muted mb-1">CUSTOMER</h4>
                <div>
                    {{ $salesOrder->first()->customer->name_customer }}
                    <br>
                    {{ $salesOrder->first()->customer->address_customer }},
                    <br>
                    {{ $salesOrder->first()->customer->city }},
                    <br>
                    {{ $salesOrder->first()->customer->country }}
                </div>
            </div>
            <div class="col text-end fe w-50">
                <div class="container mb-2">
                    <h4 class="text-muted mb-1">ORDER NUMBER</h4>
                    <div>
                        {{ $salesOrder->first()->so_number }} <span class="text-muted">SO Number</span>
                        <br>
                        {{ $salesOrder->first()->order_date->format('d M, Y') }} <span class="text-muted">Order Date</span>
                        <br>
                        {{ $salesOrder->first()->term->format('d M, Y') }} <span class="text-muted">Term of Payment</span>
                    </div>
                </div>
                <div class="container">
                    <h4 class="text-muted mb-1">DELIVERY ADDRESS</h4>
                    <div>
                        {{ $salesOrder->first()->ship_to }}
                    </div>
                </div>
            </div>
        </div> --}}
        <div style="margin-bottom: 20px">
            <table>
                <tbody>
                    <tr>
                        <td>From</td>
                        <td>:</td>
                        <td>{{ $salesOrder->first()->customer->name_customer }}</td>
                    </tr>
                    <tr>
                        <td>Date Order</td>
                        <td>:</td>
                        <td>{{ $salesOrder->first()->order_date->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td>No SO</td>
                        <td>:</td>
                        <td>{{ $salesOrder->first()->so_number }}</td>
                    </tr>
                    <tr style="vertical-align: top">
                        <td style="width: 160px;">Delivery To</td>
                        <td>:</td>
                        <td style="width: 500px">{{ $salesOrder->first()->delivery_to }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <table class="table-custome">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name Item</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesOrder->sales_order_items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->product->unit }}</td>
                        <td>{{ 'Rp  '. number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ 'Rp  '. number_format($item->total_amount, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 50px;">
            <table class="table-custome grand-total-table">
                <tbody>
                    <tr>
                        <td>Total :</td>
                        <td>{{ 'Rp  '. number_format($salesOrder->sales_order_items->sum('total_amount'), 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>{{ $salesOrder->tax->name }} :</td>
                        <td>{{ 'Rp  '. number_format($salesOrder->tax->tax_value * $salesOrder->sales_order_items->sum('total_amount'), 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Grand Total :</td>
                        <td>
                            @php
                                $grandTotal = 0;
                                $subTotal = $salesOrder->sales_order_items->sum('total_amount');
                                $ppn = $salesOrder->tax->tax_value * $salesOrder->sales_order_items->sum('total_amount');
                                $grandTotal = $subTotal + $ppn;
                            @endphp
                            {{ 'Rp  '. number_format($grandTotal, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <p>Dibuat oleh,</p>
            <img src="" alt="">
            <p>( {{ $salesOrder->created_by }} ) <br> Purchasing</p>
        </div>
    </div>
</body>
</html>