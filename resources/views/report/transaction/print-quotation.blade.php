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
                <h2>PT MITO ENERGI INDONESIA</h2>
                <h6>THE BEST PARTNER & SOLUTION</h6>
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
        {{-- <h4 style="text-align: center; margin-bottom: 30px; color: rgba(0,0,0,0.85);">SURAT PENAWARAN</h4> --}}
        {{-- Detail Quotation --}}
        <div class="current-date">Pekanbaru, {{ $currentTime }}</div>

        {{-- Info no penawaran --}}
        <table id="header-cust-quo">
            <tbody>
                {{-- <tr>
                    <td>No SP</td>
                    <td>: {{ $quotation->first()->quo_code }}</td>
                </tr> --}}
                <tr>
                    <td>Hal</td>
                    <td>: Penawaran Harga Bahan Kimia</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>: -</td>
                </tr>
            </tbody>
        </table>

        <div class="wrapper-detail-cust">
            <span>Kepada Yth,</span>
            <h4>{{ $quotation->first()->project->project_name }}</h4>
            <div>Di <br> Tempat</div>
            <div style="margin-top: 40px; margin-bottom: 20px;">
                <p>Dengan hormat,
                    <br>
                    Bersama ini kami dari PT Mito Energi Indonesia selaku distributor bahan kimia industri di Kota Pekanbaru Provinsi Riau ingin menyampaikan penawaran bahan kimia untuk pengolahan air bersih sebagai berikut :
                </p>
            </div>
        </div>

        <table class="table quo-item-table" id="report-table">
            <thead>
                <tr>
                    <th style="text-align: center !important;">No</th>
                    <th>Nama Produk</th>
                    <th>Kemasan</th>
                    <th>Satuan</th>
                    <th>Harga@</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quotation->flatMap->quotation_items as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->product->name }}</td>
                    <td>{{ $data->product->packaging }}</td>
                    <td>{{ $data->product->unit }}</td>
                    <td>{{ 'Rp  '. number_format($data->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h6 style="margin-top: 20px">Syarat & Ketentuan :</h6>

        <table class="table-info">
            <tbody>
                <tr>
                    <td>Harga</td>
                    <td>: {{ $quotation->first()->tax_type }}</td>
                </tr>
                <tr>
                    <td>Pembayaran</td>
                    <td>: {{ $quotation->first()->payment_term }}</td>
                </tr>
                <tr>
                    <td>Pengiriman</td>
                    <td>: {{ $quotation->first()->type_expedition }}</td>
                </tr>
                <tr>
                    <td>Validasi Penawaran</td>
                    <td>: {{ $quotation->first()->validated_quo }}</td>
                </tr>
                <tr>
                    <td>Contact Person</td>
                    <td>: Sintia Lestari (0822 9090 9090)</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: sintia@mitoindonesia.com</td>
                </tr>
            </tbody>
        </table>
        

        <p style="margin-top: 20px; margin-bottom: 20px">Demikian surat penawaran ini kami sampaikan, atas perhatian dan kesempatan nya kami ucapkan terimakasih.</p>

        <p>Hormat kami,</p>
        <p>PT Mito Energi Indonesia</p>
        <div style="position: relative; margin-top: 10px; height: 140px;">
            <div style="position: relative">
                <img src="{{ public_path('img/logo/cap.png') }}" style="width: 240px;">
            </div>
            <div style="position: absolute; top: 0; left: 0">
                <img src="{{ public_path('img/logo/sign-sintia.png') }}" style="">
            </div>
        </div>

        <p>Sintia Lestari</p>
        <p><strong>Sales & Marketing</strong></p>

    </main>


    <footer id="report-footer">
        <p>&copy; <?php echo date("Y");?> PT Mito Energi Indonesia</h5>
    </footer>
</body>
</html>