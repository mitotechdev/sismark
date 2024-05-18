@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('quotation.index') }}">Penawaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Formulir Penawaran</li>
            </ol>
        </nav>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- card quotation --}}
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('quotation.store') }}" method="POST" class="needs-validation form-create">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nomor Customer</label>
                        <div class="col-sm-10">
                            <div class="row g-2">
                                <div class="col-md-2">
                                    <input type="text" class="form-control" readonly value="{{ $activity->code_activity }}">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" readonly value="{{ $activity->name_customer }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" readonly value="{{ $activity->name_pic_customer }}">
                                </div>

                                <div class="col-md-3">
                                    <input type="text" class="form-control" readonly value="{{ $activity->position_pic }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Data Sales</label>
                        <div class="col-sm-10">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" readonly value="{{ $activity->user->name }}">
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" readonly value="{{ $activity->location }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Informasi Penawaran</label>
                        <div class="col-sm-10">
                            <div class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="no_sp" placeholder="SP.PKU/2023/021" title="Nomor SP" required>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="type_expedition" title="Tipe Ekspedisi" required>
                                        <option value="" selected>Pilih Ekspedisi</option>
                                        <option value="Franco">Franco</option>
                                        <option value="Loco">Loco</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="type_payment" title="Pembayaran" required>
                                        <option value="" selected>Pilih Payment</option>
                                        <option value="Cash">Cash</option>
                                        <option value="15H">15 Hari</option>
                                        <option value="30H">30 Hari</option>
                                        <option value="60H">60 Hari</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Masukan remark penawaran" name="remark" style="height: 130px" required></textarea>
                                        <label for="floatingTextarea">Remark</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
        {{-- End card --}}
    </div>
@endsection
