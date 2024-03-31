@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('quotation.index') }}">Penawaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
            </ol>
        </nav>

        {{-- card quotation --}}
        {{-- <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('quotation.update', $quotation->id) }}" method="POST" class="needs-validation form-edit">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Informasi Penawaran</label>
                        <div class="col-sm-10">
                            <div class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="no_sp" placeholder="SP.PKU/2023/021" title="Nomor SP" value="{{ $quotation->no_sp }}" required>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select select-box" name="type_expedition" title="Tipe Ekspedisi" required>
                                        <option value="" selected>Pilih Ekspedisi</option>
                                        <option value="Franco" {{ $quotation->type_expedition == "Franco" ? "selected" : "" }}>Franco</option>
                                        <option value="Loco" {{ $quotation->type_expedition == "Loco" ? "selected" : "" }}>Loco</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select select-box" name="type_payment" title="Pembayaran" required>
                                        <option value="" selected>Pilih Payment</option>
                                        <option value="Cash" {{ $quotation->type_payment == "Cash" ? "selected" : "" }}>Cash</option>
                                        <option value="15H" {{ $quotation->type_payment == "15H" ? "selected" : "" }}>15 Hari</option>
                                        <option value="30H" {{ $quotation->type_payment == "30H" ? "selected" : "" }}>30 Hari</option>
                                        <option value="60H" {{ $quotation->type_payment == "60H" ? "selected" : "" }}>60 Hari</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Masukan remark penawaran" name="remark" style="height: 130px" required>{{ $quotation->remark }}</textarea>
                                        <label for="floatingTextarea">Remark</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbaharui Data</button>
                </form>
            </div>
        </div> --}}
        {{-- End card --}}
        <form action="{{ route('quotation.update', $quotation->id) }}" method="POST" class="form-create">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    Formulir Update
                </div>
                <div class="card-body">
                    <div class="row mb-3 g-3">
                        <div class="col-md-4">
                            <label class="form-label" for="basic-default-fullname">Linked To</label>
                            <select class="form-select select-box @error('project_id') is-invalid @enderror" id="project_code" name="project_id" required>
                                <option selected value="">Search code...</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ $quotation->id == $project->id ? "selected" : "" }}>{{ $project->project_code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label" for="customer">Name Customer</label>
                            <input type="hidden" value="" name="name_customer" id="name_customer">
                            <input type="text" class="form-control" id="customer" readonly disabled placeholder="Choose first reference / linked to" value="">
                        </div>
                    </div>
                    <div class="row mb-3 g-3">
                        <div class="col-md-12">
                            <label class="form-label" for="expedition-type">Expedition</label>
                            <input type="text" class="form-control" id="expedition-type" name="type_expedition" placeholder="Franco / Loco" value="{{ $quotation->type_expedition }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="validated-quo">Validate Quo</label>
                            <select class="form-select select-box @error('validated_quo') is-invalid @enderror" id="validated-quo" name="validated_quo" required>
                                <option selected value="">Select Days...</option>
                                <option value="7 Hari" {{ $quotation->validated_quo == "7 Hari" ? "selected" : "" }} >7 Hari</option>
                                <option value="2 Minggu" {{ $quotation->validated_quo == "2 Minggu" ? "selected" : "" }} >2 Minggu</option>
                                <option value="1 Bulan" {{ $quotation->validated_quo == "1 Bulan" ? "selected" : "" }} >1 Bulan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="tax-type">Tax</label>
                            <select class="form-select select-box @error('tax_type') is-invalid @enderror" id="tax-type" name="tax_type" required>
                                <option selected value="">Select Tax...</option>
                                <option value="Exclude PPN 11%" {{ $quotation->tax_type == "Exclude PPN 11%" ? "selected" : "" }} >Exclude PPN 11%</option>
                                <option value="Include PPN 11%" {{ $quotation->tax_type == "Include PPN 11%" ? "selected" : "" }} >Include PPN 11%</option>
                                <option value="Non PPN 11%" {{ $quotation->tax_type == "Non PPN 11%" ? "selected" : "" }} >Non PPN 11%</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="payment_term">Payment Term</label>
                            <select class="form-select select-box @error('payment_term') is-invalid @enderror" id="payment_term" name="payment_term" required>
                                <option selected value="">Select Payment..</option>
                                <option value="7 Hari" {{ $quotation->payment_term == "7 Hari" ? "selected" : "" }}>7 Hari</option>
                                <option value="14 Hari" {{ $quotation->payment_term == "14 Hari" ? "selected" : "" }}>14 Hari</option>
                                <option value="21 Hari" {{ $quotation->payment_term == "21 Hari" ? "selected" : "" }}>21 Hari</option>
                                <option value="30 Hari" {{ $quotation->payment_term == "30 Hari" ? "selected" : "" }}>30 Hari</option>
                                <option value="60 Hari" {{ $quotation->payment_term == "60 Hari" ? "selected" : "" }}>60 Hari</option>
                                <option value="90 Hari" {{ $quotation->payment_term == "90 Hari" ? "selected" : "" }}>90 Hari</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="desc-quo">Description Quotation</label>
                            <textarea class="form-control" name="desc_quo" id="desc-quo" cols="30" rows="10" placeholder="Enter a description quotation" required>{{ $quotation->desc_quo }}</textarea>
                        </div>
                        <div class="col-12">
                            <div class="form-text mb-1">Select a sales person for the attached quotation</div>
                            <select class="form-select select-box @error('user_id') is-invalid @enderror" name="user_id" required>
                                <option selected value="">Select Salesperson...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $quotation->user_id == $user->id ? "selected" : "" }} >{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Data</button>
                </div>
            </div>
            
        </form>
    </div>
@endsection
