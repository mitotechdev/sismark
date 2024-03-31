<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation Sheet</title>
    <link rel="stylesheet"  href="{{ public_path('css/report.css') }}" type="text/css">
    <style>
        body {
            margin: 0px 40px !important;
        }
    </style>

</head>
<body>
    <header id="report-header" style="height: 110px;">
        <div class="wrapper-header">
            <div class="col-sec-1" style="width: 15%; text-align: center !important;">
                <img src="{{ public_path('img/logo/mei.png') }}" style="width: 90%;">
            </div>
            <div class="col-sec-2" style="text-align: center !important;">
                <h3>PT MITO ENERGI INDONESIA</h3>
                <h4>THE BEST PARTNER & SOLUTION</h4>
                <div style="font-size: 13px;">Komp. Taman Harapan Indah Blk. C No.16, Kec, Jl. Riau Gg. Harapan 2. Payung Sekaki, Kota Pekanbaru, Riau 28292</div>
                <div style="font-size: 13px;">Website: <a href="www.mitoindonesia.com">www.mitoindonesia.com</a>, Email: ptmei.official@gmail.com, Telp: (0761) 5795004, </div>

            </div>
            <div class="col-sec-3" style="margin-top: 20px; width: 15%; text-align: center">
                <img src="{{ public_path('img/logo/logo_iscc_iso.png') }}" style="width: 110%" alt="">
            </div>
        </div>
    </header>

    <hr style="margin-bottom: 2px; margin-top: 10px">
    <hr>

    
    <main id="report-content" class="quo-item">
        <h3 style="text-align: center; margin-bottom: 30px;">PURCHASES ORDER</h3>
        <div class="current-date">Pekanbaru,</div>

        <div class="wrapper-detail-cust" style="margin-bottom: 30px">
            <span>Customer</span>
            <div>{{ $salesOrder->first()->customer->name_customer }}</div>
            <div>{{ $salesOrder->first()->customer->address_customer }},</div>
            <div>{{ $salesOrder->first()->customer->city }},</div>
            <div>{{ $salesOrder->first()->customer->country }}</div>
        </div>

        <table class="table quo-item-table" id="report-table">
            <thead>
                <tr>
                    <th style="text-align: center !important;">No</th>
                    <th>Nama Produk</th>
                    <th>QTY</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesOrderItems as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->product->packaging }}</td>
                        <td>{{ 'Rp  '. number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ 'Rp  '. number_format($item->total_amount, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h6 style="margin-top: 20px">Syarat & Ketentuan :</h6>

        
        

        <p style="margin-top: 20px; margin-bottom: 20px">Demikian surat penawaran ini kami sampaikan, atas perhatian dan kesempatan nya kami ucapkan terimakasih.</p>

        <p>Hormat kami,</p>
        <p>PT Mito Energi Indonesia</p>
        <div style="position: relative; margin-top: 10px; height: 140px;">
            {{-- <div style="position: relative">
                <img src="{{ public_path('img/logo/cap.png') }}" style="width: 240px;">
            </div> --}}
            <div
            {{-- style="position: absolute; top: 0; left: 0" --}}
            >
                <img src="{{ public_path('img/logo/sign-sintia.png') }}" style="">
            </div>
        </div>

        <p>Gea Nabila</p>
        <p><strong>Admin Sales</strong></p>

    </main>


    <footer id="report-footer">
        <p>&copy; <?php echo date("Y");?> PT Mito Energi Indonesia</h5>
    </footer>
</body>
</html>