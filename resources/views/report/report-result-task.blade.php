<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Tasks Sheet</title>
    <link rel="stylesheet"  href="{{ public_path('css/report-task.css') }}" type="text/css">
    <style>
        body {
            margin: 0px 20px !important;
        }
    </style>

</head>
<body>
    {{-- <header id="report-header" style="height: 110px; vertical-align: baseline">
        <div class="wrapper-header">
            <div class="col-sec-1" style="width: 15%; text-align: center !important;">
                <img src="{{ public_path('img/logo/mei.png') }}" style="width: 90%;">
            </div>
            <div class="col-sec-2" style="text-align: center !important;">
                <h2 class="text-title">PT MITO ENERGI INDONESIA</h2>
                <h6 class="text-title">THE BEST PARTNER & SOLUTION</h6>
                <div style="font-size: 13px;">Komp. Taman Harapan Indah Blk. C No.16, Kec, Jl. Riau Gg. Harapan 2. Payung Sekaki, Kota Pekanbaru, Riau 28292</div>
                <div style="font-size: 13px;">Website: <a href="www.mitoindonesia.com">www.mitoindonesia.com</a>, Email: ptmei.official@gmail.com, Telp: (0761) 5795004, </div>

            </div>
            <div class="col-sec-3" style="margin-top: 20px; width: 15%; text-align: center">
                <img src="{{ public_path('img/logo/logo_iscc_iso.png') }}" style="width: 110%" alt="">
            </div>
        </div>
    </header> --}}

    {{-- <hr style="margin-top: 40px"> --}}
    
    <main>
        <p style="text-align: right">Pekanbaru, {{ date('d M, Y') }}</p>

        <h3 style="opacity: .75; margin-bottom: 5px;">{{ Auth::user()->full_name}} Report</h3>
        <p style="margin: 0 0 5px 0;">Tag untuk P = Progress, D = Done</p>
        <table class="table table-task">
            <thead>
                <tr>
                    <th">No</th>
                    <th>Tag</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Kegiatan</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($tasks) --}}
                @foreach ($tasks as $key => $task)
                    <tr><td colspan="6" class="name-customer">{{ $key }}</td></tr>
                    @foreach ($task as $item)
                    <tr style="vertical-align: baseline">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($item->status_task == 0)
                            P
                            @else
                            D   
                            @endif
                        </td>
                        <td>{{ date('d/m/Y', strtotime($item->start_date)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->due_date)) }}</td>
                        <td>{{ $item->name_task }}</td>
                        <td>{{ $item->desc_task }}</td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>


    </main>
</body>
</html>