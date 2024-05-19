@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Payment</h4>
        <div class="col-sm-6">
            <div class="card">
                @can('create-payments')
                <div class="card-header">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-info alert-dismissible text-black" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('payment.store') }}" method="POST" class="needs-validation form-create">
                        @csrf
                        @method('POST')
                        <div class="row g-3">
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name" placeholder="10 Hari" required>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-outline-primary" type="submit">
                                    Save Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endcan
                <div class="card-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name Payment</th>
                                <th>Act.</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 13px;">
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->name }}</td>
                                    <td>
                                        @can('edit-payments')
                                        <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editPaymentType-{{ $payment->id }}">
                                            <i class='bx bxs-edit'></i>
                                        </button>
                                        
                                        <div class="modal fade" id="editPaymentType-{{ $payment->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <form action="{{ route('payment.update', $payment->id) }}" method="POST" class="needs-validation form-edit">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Information Payment</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col">
                                                                <label for="name_payment" class="form-label">Name Payments</label>
                                                                <input class="form-control" type="text" name="name" id="name_payment" value="{{ $payment->name }}" autocomplete="off" spellcheck="false" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save Data</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endcan

                                        @can('delete-payments')
                                        <form action="{{ route('payment.destroy', $payment->id) }}" method="POST" class="needs-validation form-destroy d-inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">
                                                <i class='bx bxs-trash'></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

