@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Menu Sales Order</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('sales-order.index') }}">Sales Order</a>
                </li>
                <li class="breadcrumb-item active">Update</li>
            </ol>
        </nav>
        
        <form action="{{ route('sales-order.update', $salesOrder->id) }}" method="POST" class="needs-validation form-edit">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    {{-- Alert Errors --}}
                    @foreach ($errors->all() as $message)
                        <div class="alert alert-danger alert-dismissible text-black" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                    {{-- Alert Error --}}
                    <h5>Data Sales Order</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3 g-3">
                        <div class="col-12">
                            <label for="po_customer" class="form-label">PO Customer</label>
                            <input type="text" class="form-control" name="po_number" id="po_customer" title="PO Number Customer" value="{{ $salesOrder->so_number }}" placeholder="Enter a po number customer" required>
                        </div>
                        <div class="col-md-6">
                            <label for="customer-id" class="form-label">Customer</label>
                            <select name="customer_id" id="customer-id" class="form-select select-box @error('customer_id') is-invalid @enderror" required>
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $salesOrder->customer_id == $customer->id ? "selected" : "" }}>{{ $customer->name_customer }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="sales-person" class="form-label">Sales Person</label>
                            <select name="sales_id" id="sales-person" class="form-select select-box
                                    @error('sales_id')
                                        is-invalid
                                    @enderror "
                                    title="Sales Person" required>
                                <option value="" selected>Choose Sales...</option>
                                <option value="Sintia Lestari" {{ $salesOrder->sales_person == "Sintia Lestari" ? "selected" : "" }} >Sintia Lestari</option>
                                <option value="MITO" {{ $salesOrder->sales_person == "MITO" ? "selected" : "" }} >MITO</option>
                                <option value="Yudha Satria" {{ $salesOrder->sales_person == "Yudha Satria" ? "selected" : "" }} >Yudha Satria</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="order-date" class="form-label">Order Date</label>
                            <input type="date" class="form-control" name="order_date" id="order-date" readonly value="{{ $salesOrder->order_date }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="term-of-payment" class="form-label">Category Payment</label>
                            <select name="term" id="term-of-payment" class="form-select" required>
                                <option value="" selected>Select Category</option>
                                <option value="7 Hari" {{ $salesOrder->term == "7 Hari" ? "selected" : "" }}>7 Hari</option>
                                <option value="14 Hari" {{ $salesOrder->term == "14 Hari" ? "selected" : "" }}>14 Hari</option>
                                <option value="21 Hari" {{ $salesOrder->term == "21 Hari" ? "selected" : "" }}>21 Hari</option>
                                <option value="30 Hari" {{ $salesOrder->term == "30 Hari" ? "selected" : "" }}>30 Hari</option>
                                <option value="60 Hari" {{ $salesOrder->term == "60 Hari" ? "selected" : "" }}>60 Hari</option>
                                <option value="90 Hari" {{ $salesOrder->term == "90 Hari" ? "selected" : "" }}>90 Hari</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="ship-to" class="form-label">Ship To</label>
                            <input type="text" class="form-control @error('ship_to') is-invalid @enderror" name="ship_to" placeholder="Enter address" value="{{ $salesOrder->ship_to }}" title="Alamat Pengantaran" required>
                        </div>
                        <div class="col-12">
                            <label for="desc-sales-order" class="form-label">Additional Information</label>
                            <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc-sales-order" cols="30" rows="10" title="Informasi Tambahan" required>{{ $salesOrder->desc }}</textarea>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" name="taxable" type="checkbox" id="taxable" {{ $salesOrder->taxable == true ? "checked" : "" }}>
                                <label class="form-check-label" for="taxable">Dikenakan Pajak PPN 11%</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
        

    </div>
@endsection

@push('script')
    <script>
        $("#addProduct").on("hidden.bs.modal",function(){
            form_add_item.reset();
        });
    </script>
@endpush
