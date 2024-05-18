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

                @can('create-sales-order')
                <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addOrder">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">Add Order</span>
                </button>
                
                <!-- Modal -->
                <form action="{{ route('sales-order.store') }}" method="POST" novalidate class="needs-validation form-create" id="form_create">
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
                                            <label for="so_number" class="form-label">No Sales Order</label>
                                            <input type="text" class="form-control" name="so_number" id="so_number" title="No Sales Order" placeholder="13076" autocomplete="off" required>
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
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="order_date" class="form-label">Order Date</label>
                                            <input type="date" class="form-control" name="order_date" id="order_date" title="Order Date" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="payment_id" class="form-label">Period Payment</label>
                                            <select name="payment_id" id="payment_id" class="form-select select-box" required>
                                                <option value="" selected>Choose Payment...</option>
                                                @foreach ($payments as $payment)
                                                    <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="tax_id" class="form-label">Tax</label>
                                            <select name="tax_id" id="tax_id" class="form-select select-box" title="Tax" required>
                                                <option value="" selected>Choose Tax...</option>
                                                @foreach ($taxes as $tax)
                                                    <option value="{{ $tax->id }}">{{ $tax->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="delivery_to" class="form-label">Delivery To</label>
                                            <input type="text" class="form-control @error('delivery_to') is-invalid @enderror" name="delivery_to" placeholder="Jl. Soekarno Hatta No. 17, Pekanbaru" value="{{ old('delivery_to') }}" title="Delivery Address" autocomplete="off" spellcheck="false" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="desc_order" class="form-label">Additional Information</label>
                                            <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc_order" spellcheck="false" cols="30" rows="10" title="Additional Information" required>{{ old('desc') }}</textarea>
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
                @endcan

            </div>
            <div class="card-body">
                <table class="table table-bordered datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th data-priority="1">#</th>
                            <th data-priority="3">SO Number</th>
                            <th data-priority="2">Customer</th>
                            <th>Order In</th>
                            <th>TOP</th>
                            <th>Grand Total</th>
                            <th>Status</th>
                            <th>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subTotal = 0;
                        @endphp
                        @foreach ($salesOrders as $item)
                        <tr>


                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->so_number }}</td>
                            <td>{{ $item->customer->name_customer }}</td>
                            <td style="text-transform: uppercase">{{ date('d M, Y', strtotime($item->order_date)) }}</td>
                            <td>{{ $item->payment->name }}</td>
                            <td>
                                @php
                                   $total = $item->sales_order_items->sum('total_amount');
                                   $ppn = $total * $item->tax->tax_value;
                                @endphp
                                {{ 'Rp  '. number_format($granTotal = $total + $ppn, 2, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge rounded-pill bg-label-{{ $item->approval->tag_front_end }} py-2 px-3 mb-2">{{ $item->approval->name }}</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-transparant btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @can('read-sales-order-item')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('sales-order.item', $item->id) }}">
                                                <span class="badge rounded-pill bg-info">{{ $item->sales_order_items->count() }}</span>
                                                Item</a>
                                        </li>
                                        @endcan
                                        <li><a class="dropdown-item" href="{{ route('sales-order.document', $item->id) }}" target="__blank">Print</a></li>
                                        @if ($item->approval->id == 1)
                                            @can('edit-sales-order')
                                            <li><a class="dropdown-item" href="{{ route('sales-order.edit', $item->id) }}">Edit</a></li>
                                            @endcan
                                        @else
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                                                    <i class='bx bx-lock-alt me-2'></i>
                                                    <span>Edit</span>
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{ route('sales-order.show', $item->id) }}">Read More</a></li>
                                        @endif
                                        @can('delete-sales-order')
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Remove</a></li>
                                        @endcan
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
