@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Menu Penawaran</h4>

        {{-- Table View List Quotation --}}
        <div class="card mb-4">
            <div class="card-header">
                
                @if ($message = Session::get('success'))
                    <div class="alert alert-info alert-dismissible text-black" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible text-black" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible text-black" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach

                <h5>Data Quotation</h5>
                @can('create-quotation')
                <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addQuotation">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">Add Quotation</span>
                </button>
                
                <!-- Modal -->
                <form action="{{ route('quotation.store') }}" method="POST" novalidate class="needs-validation form-create">
                    @csrf
                    @method('POST')
                    <div class="modal fade" id="addQuotation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Form Quotation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3 g-3">
                                        <div class="col-12">
                                            <label class="form-label" for="type_quo">Type Quotation</label>
                                            <select class="form-select select-box @error('type_quo') is-invalid @enderror" id="type_quo" name="type_quo" required>
                                                <option selected value="">Choose type...</option>
                                                <option value="1">Produk</option>
                                                <option value="2">Jasa</option>
                                                <option value="3">Jasa & Produk</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="tax">Subject</label>
                                            <input type="text" class="form-control" name="subject" autocomplete="off" spellcheck="false" placeholder="Penawaran harga..." required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="project_code">Linked To</label>
                                            <select class="form-select select-box @error('project_id') is-invalid @enderror" id="project_code" name="project_id" autofocus required>
                                                <option selected value="">Search code...</option>
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? "selected" : "" }}>{{ $project->project_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="customer">Name Customer</label>
                                            <input type="text" class="form-control" id="customer" readonly disabled placeholder="Choose first reference / linked to" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-3 g-3">
                                        <div class="col-md-12">
                                            <label class="form-label" for="expedition">Expedition</label>
                                            <input type="text" class="form-control" id="expedition" name="expedition" placeholder="Franco Gudang" title="Expedition" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="validated">Validate</label>
                                            <input type="text" class="form-control" name="validated" id="validated" placeholder="14 Hari" title="Validated Quotation" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="tax">Tax</label>
                                            <input type="text" class="form-control" name="tax" id="tax" placeholder="PPN 11%" title="Tax" autocomplete="off" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label class="form-label" for="payment">Payment Term</label>
                                            <input type="text" class="form-control" name="payment" id="payment" placeholder="Cash" title="Term of Payment" autocomplete="off" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="desc-quo">Description Quotation</label>
                                            <textarea class="form-control" name="desc_quo" id="desc-quo" cols="30" rows="8" placeholder="Enter a description quotation" spellcheck="false" required></textarea>
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
                <table class="table table-bordered datatable" id="table" style="width:100%; font-size: 14px;">
                    <thead>
                        <tr>
                            <th data-priority='1'>#</th>
                            <th data-priority="3">No QUO</th>
                            <th data-priority="2">Customer</th>
                            <th>PPN</th>
                            <th>TOP</th>
                            <th>Date Input</th>
                            <th>Created By</th>
                            <th data-priority="4">Status</th>
                            <th data-priority='5'>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotations as $quo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-nowrap">{{ $quo->code }}</td>
                                <td>{{ $quo->project->customer->name_customer }}</td>
                                <td class="text-nowrap">{{ $quo->tax }}</td>
                                <td class="text-nowrap">{{ $quo->payment }}</td>
                                <td>{{ $quo->created_at->format('d/m/Y') }}</td>
                                <td>{{ $quo->user->nickname }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-label-{{ $quo->approval->tag_front_end }} py-2 px-3">{{ $quo->approval->name }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-transparant btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if (Auth::user()->id == $quo->user_id || Auth::user()->hasRole('Super Admin'))
                                                @can('read-quotation-item')
                                                    <li><a class="dropdown-item" href="{{ route('quotation.show', $quo->id) }}">Items</a></li>
                                                @endcan
                                                
                                                @can('edit-quotation')
                                                    <li><a class="dropdown-item" href="{{ route('quotation.edit', $quo->id) }}">Update</a></li>
                                                @endcan
                                            @endif
                                            @if ($quo->approval->name == "Draf")
                                            <li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                                                    <i class='bx bx-lock-alt'></i>
                                                    <span>Print</span>
                                                </a>
                                            </li>
                                            @else
                                                <form action="{{ route('print.quotation') }}" method="POST" target="__blank">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" value="{{ $quo->id }}" name="quo_id">
                                                    <button class="btn dropdown-item" type="submit">Print</button>
                                                </form>
                                            @endif

                                            @can('delete-quotation')
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
        {{-- End --}}
    </div>
@endsection

@push('script')
    <script>
        project_code.addEventListener('change', function() {
            if(this.value) {
                fetch(`api/project/${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        customer.value = data.customer.name_customer;
                    })
                    .catch(error => console.error('Error:', error));
            }
            customer.value = '';
        });
    </script>
@endpush
