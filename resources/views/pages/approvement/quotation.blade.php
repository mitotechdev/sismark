@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Approvement</h4>
        <div class="card">
            <div class="card-header">List approval Quotation</div>
            <div class="card-body">
                <table class="table datatable w-100">
                    <thead>
                        <tr>
                            <th data-priority='1' style="width: 5%">#</th>
                            <th>No Quo</th>
                            <th data-priority="2">Customer</th>
                            <th>PPN</th>
                            <th>TOP</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th data-priority='5'>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotations as $quo)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $quo->code }}</td>
                            <td>{{ $quo->project->customer->name_customer }}</td>
                            <td>{{ $quo->tax }}</td>
                            <td>{{ $quo->payment }}</td>
                            <td>{{ $quo->created_by }}</td>
                            <td class="bx-flashing">Waiting Approval...</td>
                            <td>
                                <div class="d-inline-flex">
                                    <form action="{{ route('approvement.quotation.approve', $quo->id) }}" method="POST" class="needs-validation form-approve me-2">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-outline-info">Approve</button>
                                    </form>
    
                                    <form action="{{ route('approvement.quotation.reject', $quo->id) }}" method="POST" class="needs-validation form-reject">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Reject</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ Vite::asset('resources/js/approvement.js') }}"></script>
@endpush