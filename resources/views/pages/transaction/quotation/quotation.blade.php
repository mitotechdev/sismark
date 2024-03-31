@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Menu Penawaran</h4>

        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Table View List Quotation --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5>Data Quotation</h5>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">Add Quotation</span>
                </button>
                
                <!-- Modal -->
                <form action="{{ route('quotation.store') }}" method="POST" class="form-create">
                    @csrf
                    @method('POST')
                    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Quotation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3 g-3">
                                        <div class="col-md-4">
                                            <label class="form-label" for="basic-default-fullname">Linked To</label>
                                            <select class="form-select select-box @error('project_id') is-invalid @enderror" id="project_code" name="project_id" required>
                                                <option selected value="">Search code...</option>
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? "selected" : "" }}>{{ $project->project_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label" for="customer">Name Customer</label>
                                            <input type="hidden" value="" name="name_customer" id="name_customer">
                                            <input type="text" class="form-control" id="customer" readonly disabled placeholder="Choose first reference / linked to" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-3 g-3">
                                        <div class="col-md-12">
                                            <label class="form-label" for="expedition-type">Expedition</label>
                                            <input type="text" class="form-control" id="expedition-type" name="type_expedition" placeholder="Franco / Loco" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="validated-quo">Validate Quo</label>
                                            <select class="form-select select-box @error('validated_quo') is-invalid @enderror" id="validated-quo" name="validated_quo" required>
                                                <option selected value="">Select Days...</option>
                                                <option value="7 Hari">7 Day</option>
                                                <option value="2 Minggu">2 Week</option>
                                                <option value="1 Bulan">1 Month</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="tax-type">Tax</label>
                                            <select class="form-select select-box @error('tax_type') is-invalid @enderror" id="tax-type" name="tax_type" required>
                                                <option selected value="">Select Tax...</option>
                                                <option value="Exclude PPN 11%">Exclude PPN 11%</option>
                                                <option value="Include PPN 11%">Include PPN 11%</option>
                                                <option value="Non PPN 11%">Non PPN 11%</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="payment_term">Payment Term</label>
                                            <select class="form-select select-box @error('payment_term') is-invalid @enderror" id="payment_term" name="payment_term" required>
                                                <option selected value="">Select Payment..</option>
                                                <option value="7 Hari">7 Hari</option>
                                                <option value="14 Hari">14 Hari</option>
                                                <option value="21 Hari">21 Hari</option>
                                                <option value="30 Hari">30 Hari</option>
                                                <option value="60 Hari">60 Hari</option>
                                                <option value="90 Hari">90 Hari</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="desc-quo">Description Quotation</label>
                                            <textarea class="form-control" name="desc_quo" id="desc-quo" cols="30" rows="10" placeholder="Enter a description quotation" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-text mb-1">Select a sales person for the attached quotation</div>
                                            <select class="form-select select-box @error('user_id') is-invalid @enderror" name="user_id" required>
                                                <option selected value="">Select Salesperson...</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
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
                <table class="table table-bordered text-nowrap table-striped" id="table" style="width:100%">
                    <thead>
                        <tr>
                            <th data-priority='1' style="width: 5%">#</th>
                            <th data-priority='3'>No SP</th>
                            <th data-priority="2" style="width: 35%">Customer</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th data-priority='5'>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotations as $quo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $quo->quo_code }}</td>
                                <td>{{ $quo->project->project_name }}</td>
                                <td>{{ $quo->created_at->diffForHumans() }}</td>
                                <td>
                                    @if ($quo->status == "Draf")
                                        <span class="badge rounded-pill bg-label-warning py-2 px-3 mb-2">{{ $quo->status }}</span>
                                    @elseif ($quo->status == "Request")
                                        <span class="badge rounded-pill bg-label-primary py-2 px-3 mb-2">{{ $quo->status }}</span>
                                    @elseif ($quo->status == "Cancelled")
                                        <span class="badge rounded-pill bg-label-secondary py-2 px-3 mb-2">{{ $quo->status }}</span>
                                    @elseif ($quo->status == "Approved")
                                        <span class="badge rounded-pill bg-label-success py-2 px-3 mb-2">{{ $quo->status }}</span>
                                    @else
                                        <span class="badge rounded-pill bg-label-danger py-2 px-3 mb-2">{{ $quo->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-transparant btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('quotation.show', $quo->id) }}">Items</a></li>

                                        @if ($quo->status == "Draf")
                                            <li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                                                    <i class='bx bx-lock-alt'></i>
                                                    <span>Print</span>
                                                </a>
                                            </li>
                                        @else

                                        <li><a class="dropdown-item" href="{{ route('print.quotation', $quo->id) }}" target="__blank">Print</a></li>
                                        @endif
                                        <li><a class="dropdown-item" href="{{ route('quotation.edit', $quo->id) }}">Update</a></li>
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
        {{-- End --}}
    </div>
@endsection

@push('script')
    <script>
        project_code.addEventListener('change', function() {
            if(this.value) {
                fetch(`/reference-project/${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        // console.log(data.project_name);
                        customer.value = data.project_name;
                        name_customer.value = data.project_name;

                    })
                    .catch(error => console.error('Error:', error));
            }
            customer.value = '';
            name_customer.value = '';
        });
    </script>
@endpush
