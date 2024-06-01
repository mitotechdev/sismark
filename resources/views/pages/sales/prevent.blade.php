@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Prevent</h4>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="reject-tab" data-bs-toggle="tab" data-bs-target="#reject-tab-pane" type="button" role="tab" aria-controls="reject-tab-pane" aria-selected="true">Reject</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="request-tab" data-bs-toggle="tab" data-bs-target="#request-tab-pane" type="button" role="tab" aria-controls="request-tab-pane" aria-selected="false">Request</button>
            </li>
        </ul>

        @can('create-prevent')
            <div class="tab-content bg-white" id="myTabContent">
                {{-- tab for reject --}}
                <div class="tab-pane fade show active" id="reject-tab-pane" role="tabpanel" tabindex="0">
                    <div class="alert alert-warning text-black" role="alert">
                        <strong>Perhatian!</strong> Sales Order yang dibatalkan tidak dapat digunakan kembali.
                    </div>
                    <form action="{{ route('sales-order.reject') }}" method="POST" novalidate class="needs-validation form-create">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="no-sales-order" class="form-label">No. Sales Order</label>
                            <select class="form-select select-box mb-1" name="sales_order_id" id="no-sales-order" required>
                                <option value="" selected>Choose data...</option>
                                @foreach ($salesOrdersApprove as $item)
                                    <option value="{{ $item->id }}">{{ $item->so_number }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Data harus berstatus <strong>Approve</strong> terlebih dahulu.</div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="desc" id="description" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
                {{-- tab for rollback to request --}}
                <div class="tab-pane fade" id="request-tab-pane" role="tabpanel" tabindex="0">
                    <div class="tab-pane fade show active" id="reject-tab-pane" role="tabpanel" tabindex="0">
                        <div class="alert alert-info text-black" role="alert">
                            <strong>Perhatian!</strong> Sales Order akan dikembalikan ke request, pastikan status terakhir approved.
                        </div>

                        <form action="{{ route('sales-order.req') }}" method="POST" novalidate class="needs-validation form-create">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="no-sales-order-rollback-req" class="form-label">No. Sales Order</label>
                                <select class="form-select select-box mb-1" name="sales_order_id_rollback_req" id="no-sales-order-rollback-req" required>
                                    <option value="" selected>Choose data...</option>
                                    @foreach ($salesOrdersApprove as $item)
                                        <option value="{{ $item->id }}">{{ $item->so_number }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">Data harus berstatus <strong>Approve</strong> terlebih dahulu.</div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="desc_rollback_req" id="description" rows="4" required></textarea>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        @endcan

        <div class="card mt-3">
            <div class="card-header pb-0"><h5>Datalist</h5></div>
            <div class="card-body">
                <table class="table datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NO. SO</th>
                            <th>Customer</th>
                            <th>TOP</th>
                            <th>Grand Total</th>
                            <th>Desc</th>
                            <th>Status</th>
                            <th>Act.</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        @foreach ($salesOrders as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->so_number }}</td>
                            <td>{{ $item->customer->name_customer }}</td>
                            <td>{{ $item->payment }}</td>
                            <td>
                                @php
                                   $total = $item->sales_order_items->sum('total_amount');
                                   $ppn = $total * $item->tax->tax_value;
                                @endphp
                                {{ 'Rp  '. number_format($granTotal = $total + $ppn, 0, ',', '.') }}
                            </td>
                            <td>{{ $item->desc }}</td>
                            <td>
                                <span class="badge bg-label-danger">
                                    {{ $item->approval->name }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('sales-order.document') }}" method="POST" target="__blank">
                                    @csrf
                                    <input type="hidden" value="{{ $item->id }}" name="sales_order">
                                    <button class="btn btn-sm btn-info" type="submit">Print</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection