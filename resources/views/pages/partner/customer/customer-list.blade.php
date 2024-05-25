@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Customer</h4>

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
