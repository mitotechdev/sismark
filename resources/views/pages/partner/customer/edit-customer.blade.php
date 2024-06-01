@extends('components.app.layouts')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Customer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
            </ol>
        </nav>

        {{-- Alert Error --}}
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Error --}}

        {{-- Form Activities --}}
        <form action="{{ route('customer.update', $customer->id) }}" method="POST" class="needs-validation form-create">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5>Update Informasi</h5>
                </div>
                
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
                                    <div class="row g-3">
                                        <div class="col-md-5">
                                            <label for="name_customer" class="form-label">Nama Customer <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name_customer" name="name_customer" title="Nama Customer Baru" value="{{ $customer->name_customer }}" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="type_business" class="form-label">Jenis Perusahaan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="type_business" name="type_business" title="Jenis Perusahaan" value="{{ $customer->type_business }}" spellcheck="false" required>
                                        </div>
                                        <div class="col-md">
                                            <label for="foundation_date" class="form-label">Tanggal Berdiri <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="foundation_date" name="foundation_date" value="{{ $customer->foundation_date ? $customer->foundation_date->format('Y-m-d') : '' }}" title="Tanggal Berdiri Perusahaan">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="npwp" class="form-label">NPWP Perusahaan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="npwp" name="npwp" title="NPWP Perusahaan" value="{{ $customer->npwp }}" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="owner" class="form-label">Pemilik Perusahaan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="owner" name="owner" title="Pemilik Perusahaan" value="{{ $customer->owner }}" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="total_employee" class="form-label">Jumlah Karyawan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="total_employee" name="total_employee" title="Total Employee" value="{{ $customer->total_employee }}" autocomplete="off" placeholder="11-50 Karyawan" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="address" name="address_customer" title="Alamat Perusahaan" value="{{ $customer->address_customer }}" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city" class="form-label">Kota <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="city" name="city" title="Kota" value="{{ $customer->city }}" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="country" class="form-label">Negara <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="country" name="country" title="Negara/Wilayah" value="{{ $customer->country }}" spellcheck="false" required>
                                        </div>
                                        @role('Super Admin')
                                        <div class="col-md-6">
                                            <label for="pic_sales" class="form-label">Nama Sales/Marketing <span class="text-danger">*</span></label>
                                            <select name="user_id" id="pic_sales" class="form-select select-box" title="Nama PIC / Marketing MITO" required>
                                                <option value="" selected>Pilih Sales / Marketing</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{ $user->id == $customer->user_id ? "selected" : "" }}>{{ $user->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endrole
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
                                    <div class="sub-head-info mb-3">
                                        <small>Kosongan bagian data ini dengan tanda (-) jika tidak ada.</small>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label class="form-label" for="phone_a">Nomor Telepon <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="phone_a" name="phone_a" placeholder="Nomor Telepon" title="Nomor Telepon" value="{{ $customer->phone_a }}" spellcheck="false" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="phone_b">Nomor Telepon <span class="text-muted">(opsional)</span></label>
                                                <input type="text" class="form-control" id="phone_b" name="phone_b" placeholder="Nomor Telepon (opsional)" title="Nomor Telepon (opsional)" value="{{ $customer->phone_b }}" spellcheck="false" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label class="form-label" for="email_a">Email <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="email_a" name="email_a" placeholder="Email" title="Email" value="{{ $customer->email_a }}" spellcheck="false" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="email_b">Email <span class="text-muted">(opsional)</span></label>
                                                <input type="text" class="form-control" id="email_b" name="email_b" placeholder="Email (opsional)" title="Email (opsional)" value="{{ $customer->email_b }}" spellcheck="false" required>
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
                                            <textarea class="form-control" placeholder="Deskripsikan data teknikal disini" name="desc_technical" style="height: 100px" title="Data Teknikal" required>{{ $customer->desc_technical }}</textarea>
                                            <label>Data Teknikal</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Deskripsikan data klasifikasi disini" name="desc_clasification" style="height: 100px" title="Data Klasifikasi" required>{{ $customer->desc_clasification }}</textarea>
                                            <label>Data Klasifikasi</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Deskripsikan informasi tambahan perusahaan disini" name="add_information" style="height: 100px" title="Informasi Tambahan" required>{{ $customer->add_information }}</textarea>
                                            <label>Informasi Tambahan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
        {{-- Form Activities --}}
    </div>
@endsection