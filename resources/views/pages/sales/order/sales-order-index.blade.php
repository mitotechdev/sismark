@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Menu Sales Order</h4>
        
        <div class="card">
            <div class="card-header">
                @if ($message = Session::get('success'))
                    <div class="alert alert-info alert-dismissible text-black" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- Alert Errors --}}
                @foreach ($errors->all() as $message)
                    <div class="alert alert-danger alert-dismissible text-black" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
                {{-- Alert Error --}}
                <h5>Data Sales Order</h5>

                <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addOrder">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">Add Order</span>
                </button>
                
                <!-- Modal -->
                <form action="{{ route('sales-order.store') }}" method="POST" class="form-create" id="form_create">
                    @csrf
                    @method('POST')
                    <div class="modal fade" id="addOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Information Sales Order</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3 g-3">
                                        <div class="col-12">
                                            <label for="po_customer" class="form-label">PO Customer</label>
                                            <input type="text" class="form-control" name="po_number" id="po_customer" title="PO Number Customer" placeholder="Enter a po number customer" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="customer-id" class="form-label">Customer</label>
                                            <select name="customer_id" id="customer-id" class="form-select select-box @error('customer_id') is-invalid @enderror" required>
                                                <option value="">Select Customer</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? "selected" : "" }}>{{ $customer->name_customer }}</option>
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
                                                <option value="Sintia Lestari" {{ old('sales_id') == "Sintia Lestari" ? "selected" : "" }} >Sintia Lestari</option>
                                                <option value="MITO" {{ old('sales_id') == "MITO" ? "selected" : "" }} >MITO</option>
                                                <option value="Yudha Satria" {{ old('sales_id') == "Yudha Satria" ? "selected" : "" }} >Yudha Satria</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="order-date" class="form-label">Order Date</label>
                                            <input type="date" class="form-control" name="order_date" id="order-date" readonly value="{{ date('Y-m-d', strtotime('now')) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="term-of-payment" class="form-label">Category Payment</label>
                                            <select name="term" id="term-of-payment" class="form-select" required>
                                                <option value="" selected>Select Category</option>
                                                <option value="7 Hari" {{ old('term') == "7 Hari" ? "selected" : "" }}>7 Hari</option>
                                                <option value="14 Hari" {{ old('term') == "14 Hari" ? "selected" : "" }}>14 Hari</option>
                                                <option value="21 Hari" {{ old('term') == "21 Hari" ? "selected" : "" }}>21 Hari</option>
                                                <option value="30 Hari" {{ old('term') == "30 Hari" ? "selected" : "" }}>30 Hari</option>
                                                <option value="60 Hari" {{ old('term') == "60 Hari" ? "selected" : "" }}>60 Hari</option>
                                                <option value="90 Hari" {{ old('term') == "90 Hari" ? "selected" : "" }}>90 Hari</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="ship-to" class="form-label">Ship To</label>
                                            <input type="text" class="form-control @error('ship_to') is-invalid @enderror" name="ship_to" placeholder="Enter address" value="{{ old('ship_to') }}" title="Alamat Pengantaran" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="desc-sales-order" class="form-label">Additional Information</label>
                                            <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc-sales-order" cols="30" rows="10" title="Informasi Tambahan" required>{{ old('desc') }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="taxable" type="checkbox" id="taxable" {{ old('taxable') == "on" ? "checked" : "" }}>
                                                <label class="form-check-label" for="taxable">Dikenakan Pajak PPN 11%</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- End Modal --}}

            </div>
            <div class="card-body">
                <table class="table table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="width: 5%" data-priority="1">#</th>
                            <th style="width: 12%" data-priority="3">PO Number</th>
                            <th style="width: 30%" data-priority="2">Customer</th>
                            <th>Order In</th>
                            <th>TOP</th>
                            <th>Status</th>
                            <th>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesOrders as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->so_number }}</td>
                            <td>{{ $item->customer->name_customer }}</td>
                            <td style="text-transform: uppercase">{{ date('d M, Y', strtotime($item->order_date)) }}</td>
                            <td style="text-transform: uppercase">{{ date('d M, Y', strtotime($item->term)) }}</td>
                            <td>
                                @if ($item->status == "draf")
                                    <span class="badge rounded-pill bg-label-warning py-2 px-3 mb-2">{{ $item->status }}</span>
                                    
                                @elseif ($item->status == "request")
                                    <span class="badge rounded-pill bg-label-primary py-2 px-3 mb-2">{{ $item->status }}</span>
                                    
                                @elseif ($item->status == "approved")
                                    <span class="badge rounded-pill bg-label-success py-2 px-3 mb-2">{{ $item->status }}</span>
                                @elseif ($item->status == "reject")
                                    <span class="badge rounded-pill bg-label-danger py-2 px-3 mb-2">{{ $item->status }}</span>
                                @else
                                    <span class="badge rounded-pill bg-label-secondary py-2 px-3 mb-2">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-transparant btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('order.item', $item->id) }}">
                                                <span class="badge rounded-pill bg-info">{{ $item->sales_order_items->count() }}</span>
                                                Item</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('print.sales.order', $item->id) }}" target="__blank">Print</a></li>
                                        @if ($item->status == 'draf')
                                            <li><a class="dropdown-item" href="{{ route('sales-order.edit', $item->id) }}">Edit</a></li>
                                        @else
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                                                    <i class='bx bx-lock-alt me-2'></i>
                                                    <span>Edit</span>
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{ route('sales-order.show', $item->id) }}">Read More</a></li>
                                        @endif
                                        
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Remove</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        

    </div>
@endsection

@push('script')
    <script>
        $("#addProduct").on("hidden.bs.modal",function(){
            form_add_item.reset();
        });
    </script>
@endpush
