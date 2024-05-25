@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Menu Customer</h4>

        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Form Customer --}}
        @can('create-customer')
        <form action="{{ route('customer.store') }}" method="POST" class="needs-validation form-create">
            @csrf
            @method('POST')
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
                                    <div class="row g-3">
                                        <div class="col-md-5">
                                            <label for="name_customer" class="form-label">Nama Customer <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name_customer" name="name_customer" title="Nama Customer Baru" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="type_business" class="form-label">Jenis Perusahaan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="type_business" name="type_business" title="Jenis Perusahaan" required>
                                        </div>
                                        <div class="col-md">
                                            <label for="foundation_date" class="form-label">Tanggal Berdiri <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="foundation_date" name="foundation_date" title="Tanggal Berdiri Perusahaan">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="npwp" class="form-label">NPWP Perusahaan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="npwp" name="npwp" title="NPWP Perusahaan" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="owner" class="form-label">Pemilik Perusahaan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="owner" name="owner" title="Pemilik Perusahaan" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="total_employee" class="form-label">Jumlah Karyawan <span class="text-danger">*</span></label>
                                            <select class="form-select" name="total_employee" id="total_employee" required>
                                                <option value="" selected>Pilih </option>
                                                <option value="<10">&lt; 10 Karyawan</option>
                                                <option value="11-50">11-50 Karyawan</option>
                                                <option value="51-100">51-100 Karyawan</option>
                                                <option value="101-500">101-500 Karyawan</option>
                                                <option value="501-1000">501-1000 Karyawan</option>
                                                <option value="1001-5000">1001-5000 Karyawan</option>
                                                <option value="5001-10001">5001-10000 Karyawan</option>
                                                <option value="10001+">10001+ Karyawan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="address" name="address_customer" title="Alamat Perusahaan" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city" class="form-label">Kota <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="city" name="city" title="Kota" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="country" class="form-label">Negara <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="country" name="country" title="Negara/Wilayah" required>
                                        </div>
                                        @role('Super Admin')
                                        <div class="col-md-6">
                                            <label for="pic_sales" class="form-label">Nama Sales/Marketing <span class="text-danger">*</span></label>
                                            <select name="user_id" id="pic_sales" class="form-select select-box" title="Nama PIC / Marketing MITO" required>
                                                <option value="" selected>Pilih Sales / Marketing</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
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
                                                <input type="text" class="form-control" id="phone_a" name="phone_a" placeholder="Nomor Telepon" title="Nomor Telepon" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="phone_b">Nomor Telepon <span class="text-muted">(opsional)</span></label>
                                                <input type="text" class="form-control" id="phone_b" name="phone_b" placeholder="Nomor Telepon (opsional)" title="Nomor Telepon (opsional)" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label class="form-label" for="email_a">Email <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="email_a" name="email_a" placeholder="Email" title="Email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="email_b">Email <span class="text-muted">(opsional)</span></label>
                                                <input type="text" class="form-control" id="email_b" name="email_b" placeholder="Email (opsional)" title="Email (opsional)" required>
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
                                            <textarea class="form-control" placeholder="Deskripsikan data teknikal disini" name="desc_technical" style="height: 100px" title="Data Teknikal" required></textarea>
                                            <label for="floatingTextarea2">Data Teknikal</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Deskripsikan data klasifikasi disini" name="desc_clasification" style="height: 100px" title="Data Klasifikasi" required></textarea>
                                            <label for="floatingTextarea2">Data Klasifikasi</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Deskripsikan informasi tambahan perusahaan disini" name="add_information" style="height: 100px" title="Informasi Tambahan" required></textarea>
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
                                <div class="accordion-body p-3" x-data="handler()">
                                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                        <small>Bagian ini merupakan data-data kontak customer. Kosongan dengan tanda (-) jika tidak ada.</small>
                                        <div class="mt-2 mt-md-0">
                                            <button type="button" class="btn btn-info" x-on:click="addNewContact()">+ Tambah Data</button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row my-0">
                                            <h6 class="mb-3 text-muted">Person 1</h6>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-lg-5">
                                                <input type="text" class="form-control" id="name_pic" name="name_pic[]" placeholder="Nama Kontak" title="Nama Kontak" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="position" name="position[]" placeholder="Jabatan" title="Jabatan" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="phone_number" name="phone_number[]" placeholder="Nomor Telepon" title="Nomor Telepon" required>
                                            </div>
                                        </div>
                                    </div>
                                    <template x-for="(field, index) in fields" :key="index">
                                        <div class="mb-3">
                                            <div class="row my-0">
                                                <h6 class="mb-3 text-muted">Person <span x-text="index + 2"></span></h6>
                                            </div>

                                            <div class="row g-3">
                                                <div class="col-lg-5">
                                                    <input type="text" class="form-control" id="name_pic" name="name_pic[]" placeholder="Nama Kontak" title="Nama Kontak" required>
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="position" name="position[]" placeholder="Jabatan" title="Jabatan" required>
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="phone_number" name="phone_number[]" placeholder="Nomor Telepon" title="Nomor Telepon" required>
                                                </div>
                                                <div class="col mt-sm-auto mt-md-auto mt-3">
                                                    <button type="button" class="btn btn-danger btn-small" x-on:click="removeField(index)">&times;</button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
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
                                <div class="accordion-body p-3" x-data="handlerAddFactory()">
                                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                        <small>Silahkan tambah data pabrik atau branch customer. Kosongan dengan tanda (-) jika tidak ada.</small>
                                        <div class="mt-2 mt-md-0">
                                            <button type="button" class="btn btn-info" x-on:click="addNewFactory()">+ Tambah Data</button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row my-0">
                                            <h6 class="mb-3 text-muted">Pabrik/Branch 1</h6>
                                        </div>
                                        <div class="row g-3 mb-3">
                                            <div class="col-lg-5">
                                                <input type="text" class="form-control" id="name" name="name_branch[]" placeholder="Nama Branch / Pabrik" title="Nama Branch / Pabrik" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="type_branch" name="type_branch[]" placeholder="Jenis Branch / Pabrik" title="Jenis Branch / Pabrik" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" class="form-control" id="pic_branch" name="pic_branch[]" placeholder="PIC Branch" title="PIC Branch" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-11 mb-3">
                                            <input type="text" class="form-control" id="address_branch" name="address_branch[]" placeholder="Alamat Branch / Pabrik" title="Alamat Branch / Pabrik" required>
                                        </div>
                                        <div class="col-lg-11">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Deskripsikan pabrik / branch / Kapasitas Produksi disini" name="desc_branch[]" style="height: 100px"></textarea>
                                                <label for="floatingTextarea2">Keterangan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <template x-for="(field, index) in fields" :key="index">
                                        <div class="mb-3">
                                            <div class="row my-0">
                                                <h6 class="mb-3 text-muted">Pabrik/Branch <span x-text="index + 2"></span></h6>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-lg-5">
                                                    <input type="text" class="form-control" id="name" name="name_branch[]" placeholder="Nama Branch / Pabrik" title="Nama Branch / Pabrik" required>
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="type" name="type_branch[]" placeholder="Jenis Branch / Pabrik" title="Jenis Branch / Pabrik" required>
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="pic_branch" name="pic_branch[]" placeholder="PIC Branch" title="PIC Branch" required>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-lg-11">
                                                    <input type="text" class="form-control" id="address_branch" name="address_branch[]" placeholder="Alamat Branch / Pabrik" title="Alamat Branch / Pabrik" required>
                                                </div>
                                                <div class="col-lg-11 mb-lg-0 mb-3">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Deskripsikan pabrik / branch disini" name="desc_branch[]" style="height: 100px" required></textarea>
                                                        <label for="floatingTextarea2">Keterangan</label>
                                                    </div>
                                                </div>
                                                <div class="col mt-auto">
                                                    <button type="button" class="btn btn-danger btn-small" x-on:click="removeField(index)">&times;</button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer pt-0">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </div>
        </form>
        @endcan


        {{-- Table View --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Daftar Customer</h5>
            </div>
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table table-bordered table-striped datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="1">Nama Customer</th>
                                <th data-priority="2">Bidang Usaha</th>
                                <th data-priority="4">Kota</th>
                                <th data-priority="7">NPWP</th>
                                <th data-priority="6">Telp.</th>
                                <th data-priority="5">Status</th>
                                <th data-priority="3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->name_customer }}</td>
                                    <td>{{ $customer->type_business }}</td>
                                    <td>{{ $customer->city }}</td>
                                    <td>{{ $customer->npwp }}</td>
                                    <td>{{ $customer->phone_a }}</td>
                                    <td>
                                        <span class="badge bg-label-{{ $customer->type_customer->tag_front_end }}">{{ $customer->type_customer->name }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>

                                            <div class="dropdown-menu" style="">
                                                <a href="{{ route('customer.detail', $customer->id) }}" class="dropdown-item">Read More</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ route('customer.personalia', $customer->id) }}">Personalia</a>
                                                <a class="dropdown-item" href="{{ route('customer.branch', $customer->id) }}">Branch</a>
                                                @can('edit-customer')
                                                <a class="dropdown-item" href="{{ route('customer.edit', $customer->id) }}">Edit Customer</a>
                                                @endcan
                                                @can('delete-customer')
                                                {{-- <a class="dropdown-item" href=""><i class="bx bx-trash me-1"></i> Hapus</a>  --}}
                                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" class="needs-validation form-destroy">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn dropdown-item">Delete</button>
                                                </form>
                                                @endcan 
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- End Table View --}}
    </div>
@endsection

@push('style')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function handler() {
            return {
            fields: [],
            addNewContact() {
                this.fields.push({
                    name_pic: '',
                    position: '',
                    phone_number: '',
                });
                },
                removeField(index) {
                this.fields.splice(index, 1);
                }
            }
        }

        function handlerAddFactory() {
            return {
            fields: [],
            addNewFactory() {
                this.fields.push({
                    name_branch: '',
                    type_branch: '',
                    pic_branch: '',
                    address_branch: '',
                    desc_branch: '',
                });
                },
                removeField(index) {
                this.fields.splice(index, 1);
                }
            }
        }

        $(document).ready(function() {
            $('.select-box-2').select2({
                theme: "bootstrap-5",
                allowClear: true
            })

        });
    </script>
@endpush
