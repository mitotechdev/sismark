<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation Sheet</title>
    <link rel="stylesheet"  href="{{ public_path('css/report-quo.css') }}" type="text/css">
    <style>
        body {
            margin: 0px 40px !important;
        }
    </style>

</head>
<body>
    <header id="report-header" style="height: 100px;">
        <div class="wrapper-header">
            <div class="col-sec-1" style="width: 15%; text-align: center !important;">
                <img src="{{ public_path('img/logo/mei.png') }}" style="width: 90%;">
            </div>
            <div class="col-sec-2" style="text-align: center !important;">
                <h2 class="text-title">PT MITO ENERGI INDONESIA</h2>
                <h6 class="text-title">THE BEST PARTNER & SOLUTION</h6>
                <div style="font-size: 13px;">Komp. Taman Harapan Indah Blk. C No.16, Kec, Jl. Riau Gg. Harapan 2. Payung Sekaki, Kota Pekanbaru, Riau 28292</div>
                <div style="font-size: 13px;">Website: <a href="www.mitoindonesia.com">www.mitoindonesia.com</a>, Email: ptmei.official@gmail.com, Telp: (0761) 5795004</div>

            </div>
            <div class="col-sec-3" style="margin-top: 20px; width: 15%; text-align: center">
                <img src="{{ public_path('img/logo/logo_iscc_iso.png') }}" style="width: 110%" alt="">
            </div>
        </div>
    </header>

    <hr>
    
    <main>
        <p style="text-align: right; margin:5px 0;">Pekanbaru, {{ $currentTime }}</p>

        {{-- Info no penawaran --}}
        <table>
            <tbody>
                <tr>
                    <td>Nomor</td>
                    {{-- <td>: 083/SPH/MITO/IV/24</td> --}}
                    <td>: {{ $quotation->code }}</td>
                </tr>
                <tr>
                    <td>Hal</td>
                    <td>: {{ $quotation->subject }}</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>: -</td>
                </tr>
            </tbody>
        </table>

        <div>
            <p>Kepada Yth, <br> <strong>{{ $quotation->first()->project->customer->name_customer }}</strong> <br> Di - <br> Tempat</p>
            <div>
                <p>Dengan hormat,
                    <br>
                    <div style="text-align: justify; text-justify: inter-word;">Bersama ini kami dari PT Mito Energi Indonesia selaku distributor bahan kimia industry, manufactur chemical specialty boiler, penjualan aksesoris water treatment dan jasa mechanical di Kota Pekanbaru Provinsi Riau ingin menyampaikan {{ $quotation->subject . ' ' . $quotation->first()->project->customer->name_customer }} sebagai berikut :</div>
                </p>
            </div>
        </div>

        <table class="table-custome mt-1">
            <thead>
                <tr>
                    <th">No</th>
                    <th>Item</th>
                    <th>Keterangan</th>
                    <th>Harga@</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quotation->quotation_items as $data)
                <tr>
                    <td style="width: 5%">{{ $loop->iteration }}</td>
                    <td style="width: 20%">{{ $data->product->name }}</td>
                    <td style="width: 55%">{{ $data->desc }}</td>
                    <td>{{ 'Rp  '. number_format($data->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p>Adapun ketentuan sebagai berikut :</p>
        <table>
            <tbody>
                <tr>
                    <td>Harga</td>
                    <td>: {{ $quotation->first()->tax}}</td>
                </tr>
                <tr>
                    <td>Pembayaran</td>
                    <td>: {{ $quotation->first()->payment }}</td>
                </tr>
                <tr>
                    <td>Pengiriman</td>
                    <td>: {{ $quotation->first()->expedition }}</td>
                </tr>
                <tr>
                    <td>Validasi Penawaran</td>
                    <td>: {{ $quotation->first()->validated }}</td>
                </tr>
                <tr>
                    <td>Contact Person</td>
                    <td>: {{ $quotation->first()->user->full_name }} ({{ $quotation->first()->user->phone_number }})</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: {{ $quotation->first()->user->email }}</td>
                </tr>
            </tbody>
        </table>
        

        <p style="margin-top: 20px; margin-bottom: 40px">Demikian surat penawaran ini kami sampaikan, atas perhatian dan kesempatan nya kami ucapkan terimakasih.</p>

        <p>Hormat kami, <br>PT Mito Energi Indonesia</p>

        <p style="margin-top: 100px">{{ $quotation->first()->user->full_name }} <br> <strong>{{ $quotation->first()->user->roles->first()->name }}</strong></p>

    </main>
</body>
</html>