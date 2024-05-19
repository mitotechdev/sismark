@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Customer</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.personalia', $customerPersonalia->customer_id) }}">Personalia</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>

        <form action="{{ route('customer-personalia.update', $customerPersonalia->id) }}" method="POST" class="needs-validation form-edit">
            @csrf
            @method('PUT')
            <input type="hidden" name="customer_id" value="{{ $c }}">
            <div class="card mb-3">
                <div class="card-header">Update Personalia</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="name_personalia" class="form-label">Nama Personalia</label>
                            <input type="text" class="form-control" id="name_personalia" name="name_pic" autocomplete="off" title="Nama personalia" value="{{ $customerPersonalia->name_pic }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="position" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="position" name="position" autocomplete="off" title="Jabatan Personalia" value="{{ $customerPersonalia->position }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="phone_number" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" autocomplete="off" title="Nomor Telepon" value="{{ $customerPersonalia->phone_number }}" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
@endsection