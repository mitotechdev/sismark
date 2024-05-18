@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Billing</h4>
        <div class="card">
            <div class="card-header">
                List billing
            </div>
            <div class="card-body">
                <table class="table table-border datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SO Number</th>
                            <th>Customer</th>
                            <th>Total Bill</th>
                            <th>Status</th>
                            <th>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $bill)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bill->so_number }}</td>
                            <td>{{ $bill->customer->name_customer }}</td>
                            <td>
                                @php
                                   $total = $bill->sales_order_items->sum('total_amount');
                                   $ppn = $total * $bill->tax->tax_value;
                                @endphp
                                {{ 'Rp  '. number_format($granTotal = $total + $ppn, 2, ',', '.') }}
                            </td>
                            @if ($bill->paid == false)
                                <td><span class="badge bg-label-danger">Unpaid</span></td>
                                <td>
                                    <form action="{{ route('sales-order.paid', $bill) }}" method="POST" class="needs-validation form-edit">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-info">Mark Paid Off</button>
                                    </form>
                                </td>
                            @else
                                <td><span class="badge bg-label-success">Paid</span></td>
                                <td><span class="badge bg-label-success">Paid</span></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
@endsection
