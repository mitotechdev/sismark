<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Purchases Order</title>
    @if ($salesOrder->approval->tag_status == 'rej')
        <link rel="stylesheet"  href="{{ public_path('css/report-sales-order-reject.css') }}" type="text/css">
    @else
        <link rel="stylesheet"  href="{{ public_path('css/report-sales-order.css') }}" type="text/css">
    @endif
</head>
<body>
    @if ($salesOrder->approval->tag_status == 'rej')
        <div class="wrapper-reject">
            <h1>REJECT</h1>
        </div>
    @endif
    <header class="header-content">
        <div class="wrapper-brand-logo">
            <img src="{{ public_path('img/logo/mei.png') }}" style="width: 80%;">
        </div>
        <div class="wrapper-company-name">
            <p class="company">PT MITO ENERGI INDONESIA</p>
            <p class="tagline">THE BEST PARTNER & SOLUTION</p>
            <p class="address-company">Komp. Taman Harapan Indah Blk. C No.16, Jl. Riau Gg. Harapan 2, Kota Pekanbaru, Riau 28292</p>
            <p class="contact-company">Website: <a href="www.mitoindonesia.com">www.mitoindonesia.com</a>, Email: ptmei.official@gmail.com, Telp: (0761) 5795004</p>
        </div>
        <div class="wrapper-certificate-brand">
            <img src="{{ public_path('img/logo/logo_iscc_iso.png') }}" style="width: 100%">
        </div>
    </header>
    <hr>
    <main>
        <div class="container">
            <div class="report-name">Purchase Order</div>
            <div class="wrapper-detail-sales">
                <div class="wrapper-left">
                    <h5>Detail order</h5>
                    <table>
                        <tbody>
                            <tr>
                                <td>From</td>
                                <td>: {{ $salesOrder->customer->name_customer }}</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>: {{ $salesOrder->order_date->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td>No SO</td>
                                <td>: {{ $salesOrder->so_number }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    
                <div class="wrapper-right">
                    <h5>Ship-to Address</h5>
                    <p>{{ $salesOrder->delivery_to }}</p>
                </div>
            </div>

            {{-- items list sales order --}}
            <div class="wrapper-datatable">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesOrder->sales_order_items as $item)
                        <tr class="datalist">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->code }}</td>
                            @if ($item->product->type_product == "Produk")
                            <td>{{ $item->product->name }}</td>
                            @else
                            <td>{{ $item->desc }}</td>
                            @endif
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->product->unit }}</td>
                            <td style="width: 170px">{{ 'Rp  '. number_format($item->price, 0, ',', '.') }}</td>
                            <td style="width: 170px">{{ 'Rp  '. number_format($item->total_amount, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        
                        <tr class="sum sub-total">
                            <td colspan="6">Sub Total</td>
                            <td>{{ 'Rp  '. number_format($salesOrder->sales_order_items->sum('total_amount'), 0, ',', '.') }}</td>
                        </tr>
                        <tr class="sum tax">
                            <td colspan="6">{{ $salesOrder->tax->name }}</td>
                            <td>{{ 'Rp  '. number_format($salesOrder->tax->tax_value * $salesOrder->sales_order_items->sum('total_amount'), 0, ',', '.') }}</td>
                        </tr>
                        <tr class="sum grand-total">
                            <td colspan="6">Grand Total</td>
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

            {{-- created by --}}
            <div class="wrapper-signature">
                <h5>Dibuat oleh,</h5>
                <p>{{ $salesOrder->created_by }}</p>
                <p>(Admin Sales)</p>
            </div>
        </div>
    </main>
</body>
</html>