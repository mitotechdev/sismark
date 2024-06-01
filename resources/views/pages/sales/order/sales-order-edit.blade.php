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
        
        <form action="{{ route('sales-order.update', $salesOrder->id) }}" method="POST" novalidate class="needs-validation form-edit">
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
                            <label for="so_number" class="form-label">No Sales Order</label>
                            <input type="text" class="form-control" name="so_number" id="so_number" title="No Sales Order" value="{{ $salesOrder->so_number }}" spellcheck="false" autocomplete="off" placeholder="13870" required>
                        </div>
                        <div class="col-md-6">
                            <label for="customer_id" class="form-label">Customer</label>
                            <select name="customer_id" id="customer_id" class="form-select select-box @error('customer_id') is-invalid @enderror" required>
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $salesOrder->customer_id == $customer->id ? "selected" : "" }}>{{ $customer->name_customer }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="sales_id" class="form-label">Sales</label>
                            <select name="sales_id" id="sales_id" class="form-select select-box
                                    @error('sales_id')
                                        is-invalid
                                    @enderror "
                                    title="Sales Person" required>
                                <option value="" selected>Choose Sales...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $salesOrder->sales_id ? "selected" : "" }}>{{ $user->nickname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="order_date" class="form-label">Order Date</label>
                            <input type="date" class="form-control" name="order_date" id="order_date" value="{{ $salesOrder->order_date->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="payment_id" class="form-label">Period Payment</label>
                            <input type="text" class="form-control" name="payment" id="payment_id" title="TOP" value="{{ $salesOrder->payment }}" autocomplete="off" placeholder="Cash" required>
                        </div>
                        <div class="col-12">
                            <label for="tax_id" class="form-label">Tax</label>
                            <select name="tax_id" id="tax_id" class="form-select select-box" required>
                                <option value="" selected>Choose Tax...</option>
                                @foreach ($taxes as $tax)
                                    <option value="{{ $tax->id }}" {{ $tax->id == $salesOrder->tax_id ? "selected" : "" }}>{{ $tax->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="delivery_to" class="form-label">Delivery To</label>
                            <input type="text" class="form-control @error('delivery_to') is-invalid @enderror" name="delivery_to" placeholder="Jl. Soekarno Hatta No. 14, Pekanbaru, Riau" value="{{ $salesOrder->delivery_to }}" title="Delivery Address" spellcheck="false" autocomplete="off" required>
                        </div>
                        <div class="col-12">
                            <label for="desc" class="form-label">Additional Information</label>
                            <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" cols="30" rows="10" title="Additional Information" spellcheck="false" required>{{ $salesOrder->desc }}</textarea>
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
