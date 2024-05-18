@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Customer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>

        <div class="card mb-3">
            <div class="card-body">
                <div class="accordion" id="accordion-data-cus-1">
                    <div class="accordion-item shadow-none mb-2">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" style="background-color: #f2f2f2" type="button" data-bs-toggle="collapse" data-bs-target="#profile-customer" aria-expanded="true">
                            Profile Perusahaan
                            </button>
                        </h2>
                        <div id="profile-customer" class="accordion-collapse collapse show">
                            <div class="accordion-body p-3">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nama Customer</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control" value="{{ $customer->name_customer }}" title="Nama Customer">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Jenis Perusahaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control" value="{{ $customer->type_business }}" title="Jenis Perusahaan Customer">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tanggal Berdiri</label>
                                    <div class="col-sm-10">
                                        @if ($customer->foundation_date !== NULL)
                                        <input type="date" readonly class="form-control" value="{{ $customer->foundation_date->format('Y-m-d') }}" title="Tanggal Berdiri Perusahaan">
                                        @else
                                        <input type="text" readonly class="form-control" value="-" title="Tanggal Berdiri Perusahaan">
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">NPWP Perusahaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control" value="{{ $customer->npwp }}" title="NPWP Perusahaan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">CEO / Pemilik Perusahaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control" value="{{ $customer->owner }}" title="Pemilik Perusahaan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Total Karyawan</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control" value="{{ $customer->total_employee }} Karyawan" title="Total Karyawan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Alamat Perusahaan</label>
                                    <div class="col-sm-10">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <input type="text" readonly class="form-control" value="{{ $customer->address_customer }}" title="Alamat Perusahaan">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" readonly class="form-control" value="{{ $customer->city }}" title="Kota">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" readonly class="form-control" value="{{ $customer->country }}" title="Negara">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item shadow-none mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button" style="background-color: #f2f2f2" type="button" data-bs-toggle="collapse" data-bs-target="#contact-customer" aria-expanded="true">
                                Kontak Perusahaan
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse show" id="contact-customer">
                            <div class="accordion-body p-3">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <input type="text" readonly class="form-control" value="{{ $customer->email_a }}" title="Email Utama Perusahaan">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" readonly class="form-control" value="{{ $customer->email_b }}" title="Email Alternatif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Kontak Perusahaan</label>
                                    <div class="col-sm-10">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <input type="text" readonly class="form-control" value="{{ $customer->phone_a }}" title="Call Center Perusahaan">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" readonly class="form-control" value="{{ $customer->phone_b }}" title="Call Center Alternatif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item shadow-none mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button" style="background-color: #f2f2f2" type="button" data-bs-toggle="collapse" data-bs-target="#detail-customer" aria-expanded="true">
                                Informasi Perusahaan
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse show" id="detail-customer">
                            <div class="accordion-body p-3">
                                <div class="sub-head-info mb-3">
                                    <small>Kosongan bagian data ini dengan tanda (-) jika tidak ada.</small>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Deskripsikan data teknikal disini" name="desc_technical" style="height: 100px" title="Data Teknikal" readonly disabled required>{{ $customer->desc_technical }}</textarea>
                                        <label for="floatingTextarea2">Data Teknikal</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Deskripsikan data klasifikasi disini" name="desc_clasification" style="height: 100px" title="Data Klasifikasi" readonly required>{{ $customer->desc_clasification }}</textarea>
                                        <label for="floatingTextarea2">Data Klasifikasi</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Deskripsikan informasi tambahan perusahaan disini" name="add_information" style="height: 100px" title="Informasi Tambahan" readonly disabled required>{{ $customer->add_information }}</textarea>
                                        <label for="floatingTextarea2">Informasi Tambahan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item shadow-none mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button" style="background-color: #f2f2f2" type="button" data-bs-toggle="collapse" data-bs-target="#personalia-customer" aria-expanded="true">
                                Data Personalia (PIC)
                            </button>
                        </h2>
                        <div id="personalia-customer" class="accordion-collapse collapse show">
                            <div class="accordion-body p-3">
                                @foreach ($customer->personalia as $key => $item)
                                <div class="mb-3">
                                    <div class="row my-0">
                                        <h6 class="mb-3 text-muted">Person {{ $key+1 }}</h6>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-lg-5">
                                            <input type="text" class="form-control" readonly value="{{ $item->name }}" placeholder="Nama Kontak" title="Nama Kontak" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" readonly value="{{ $item->role }}" placeholder="Jabatan" title="Jabatan" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" readonly value="{{ $item->phone }}" placeholder="Nomor Telepon" title="Nomor Telepon" required>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item shadow-none mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button" style="background-color: #f2f2f2" type="button" data-bs-toggle="collapse" data-bs-target="#branch-factory-customer" aria-expanded="true">
                                Branch / Pabrik
                            </button>
                        </h2>
                        <div id="branch-factory-customer" class="accordion-collapse collapse show">
                            <div class="accordion-body p-3">
                                <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                </div>
                                @foreach ($customer->customer_branch as $key => $branches)
                                    <div class="mb-3">
                                        <div class="row my-0">
                                            <h6 class="mb-3 text-muted">Pabrik/Branch {{ $key+1 }}</h6>
                                        </div>
                                        <div class="row g-3 mb-3">
                                            <div class="col-lg-5">
                                                <input type="text" class="form-control" id="name" readonly value="{{ $branches->name_branch }}" placeholder="Nama Branch / Pabrik" title="Nama Branch / Pabrik" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="type_branch" readonly value="{{ $branches->type_branch }}" placeholder="Jenis Branch / Pabrik" title="Jenis Branch / Pabrik" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="pic_branch" readonly value="{{ $branches->pic_branch }}" placeholder="PIC Branch" title="PIC Branch" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-11 mb-3">
                                            <input type="text" class="form-control" id="address_branch" readonly value="{{ $branches->address_branch }}" placeholder="Alamat Branch / Pabrik" title="Alamat Branch / Pabrik" required>
                                        </div>
                                        <div class="col-lg-11">
                                            <div class="form-floating">
                                                <textarea class="form-control" title="Deskripsi Pabrik / Branch / Tonase atau Kapasitas produksi" readonly style="height: 100px">{{ $branches->desc_branch }}</textarea>
                                                <label for="floatingTextarea2">Deskripsi Pabrik / Branch</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection