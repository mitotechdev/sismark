@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('quotation.index') }}">Quotation</a></li>
                <li class="breadcrumb-item active" aria-current="page">Items</li>
            </ol>
        </nav>

        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        @foreach ($errors->all() as $message)
            <div class="alert alert-info alert-dismissible text-black" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach

        <div class="card">
            <div class="card-header">
                <h5>Items Quotation</h5>
                <div class="d-flex align-items-center justify-content-between">
                    @can('create-quotation-item')
                    @if ($quotation->approval->name == "Draf")
                    <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addItemQuotation">
                        <i class='bx bxs-plus-circle'></i>
                        <span class="ms-1">Add Item</span>
                    </button>
                    
                    <!-- Modal -->
                    <form action="{{ route('quotation-item.store') }}" method="POST" class="form-create" id="form_add_item">
                        @csrf
                        @method('POST')
                        <input type="hidden" value="{{ $quotation->id }}" name="quotation_id">
                        <div class="modal fade" id="addItemQuotation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Information Item</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label" for="product_code">Product Code</label>
                                                <select class="form-select select-box @error('product_id') is-invalid @enderror" id="product_code" name="product_id" required>
                                                    <option value="">Search code...</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? "selected" : "" }}>{{ $product->code }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="price">Price</label>
                                                <input type="number" class="form-control" name="price_product" id="price" step=".01" title="Harga produk" value="" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="name_product">Name Product</label>
                                                <input type="text" class="form-control" id="name_product" readonly disabled placeholder="Search first code product..." value="">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="packaging">Packaging</label>
                                                <input type="text" class="form-control" id="packaging" readonly disabled placeholder="Search first code product..." title="Kemasan produk" value="">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="unit">Unit</label>
                                                <input type="text" class="form-control" name="unit" id="unit" readonly disabled placeholder="Search first code product..." title="Satuan produk" value="">
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
                    @endif
                    @endcan
    
                    @can('submit-quotation-item')
                    @if ($quotationItems->isNotEmpty() && $quotation->approval->id == 1)
                        <form action="{{ route('quotation.status', $quotation->id) }}" method="POST" class="form-submit-quotation">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-outline-success" type="submit">Open Request</button>
                        </form>
                    @endif
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th style="width: 5%" data-priority="1">#</th>
                            <th data-priority="2">Name Product</th>
                            <th>Packaging</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th data-priority="3">Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotationItems as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->product->packaging }}</td>
                                <td>{{ $item->product->unit }}</td>
                                <td>{{ 'Rp  '. number_format($item->price, 2, ',', '.') }}</td>

                                @if ($quotation->approval->id == 1 || Auth::user()->hasRole('Super Admin'))
                                <td style="width: 10%">
                                    <div class="wrap d-inline-flex">
                                        @can('edit-quotation-item')
                                        <button type="button" class="btn btn-sm btn-outline-warning me-1" data-bs-toggle="modal" data-bs-target="#updateQuoItem-{{ $item->id }}">
                                            <i class='bx bxs-edit bx-xs'></i>
                                        </button>
                                        
                                        <!-- Modal -->
                                        <form action="{{ route('quotation-item.update', $item->id) }}" method="POST" class="needs-validation form-submit-item-quo">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal fade" id="updateQuoItem-{{ $item->id }}" tabindex="-1" aria-labelledby="updateQuoItem-{{$item->id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Informasi Update</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-3 g-3">
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="product_code">Product Code</label>
                                                                    <select class="form-select select-box product_code_edit @error('product_id') is-invalid @enderror" name="product_id" data-query-id="{{ $item->id }}" required>
                                                                        <option value="">Search code...</option>
                                                                        @foreach ($products as $product)
                                                                            <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? "selected" : "" }}>{{ $product->code }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <label class="form-label">Name Product</label>
                                                                    <input type="text" class="form-control" id="name_product_view_edit_{{ $item->id }}" readonly disabled placeholder="Search first code product..." value="{{ $item->product->name }}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="packaging_product">Packaging</label>
                                                                    <input type="text" class="form-control" id="packaging_product_edit_{{ $item->id }}" readonly disabled placeholder="Search first code product..." title="Kemasan produk" value="{{ $item->product->packaging }}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="unit_product">Unit</label>
                                                                    <input type="text" class="form-control" id="unit_product_edit_{{ $item->id }}" name="unit" readonly disabled placeholder="Search first code product..." title="Satuan produk" value="{{ $item->product->unit }}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label" for="price_product">Price</label>
                                                                    <input type="number" class="form-control" id="price_product_edit_{{ $item->id }}" step=".01" name="price_product" title="Harga produk" value="{{ $item->price }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        @endcan

                                        {{-- Delete --}}
                                        @can('delete-quotation-item')
                                        <form action="{{ route('quotation-item.destroy', $item->id) }}" method="POST" class="needs-validation form-destroy">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class='bx bxs-trash-alt bx-xs'></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>

                                @else 

                                <td>
                                    <div><i class='bx bx-lock-alt'></i></div>
                                </td>
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

@push('script')
    <script>
        $("#addItemQuotation").on("hidden.bs.modal",function(){
            form_add_item.reset();
        });

        // Update product info when add new item
        function updateFieldSingleProductInfo(name_product, packaging, unit, data) {
            name_product.value = data.name || '';
            packaging.value = data.packaging || '';
            unit.value = data.unit || '';
        }
        // Update product info when update item filtering by ID
        function updateProductInfo(valueId, name_product, packaging, unit, data) {
            name_product.value = data.name || '';
            packaging.value = data.packaging || '';
            unit.value = data.unit || '';
        }

        product_code.addEventListener('change', function() {
            if(this.value) {
                fetch(`/api/product/${this.value}`)
                    .then(response => response.json())
                    .then(data => updateFieldSingleProductInfo(name_product, packaging, unit, data))
                    .catch(error => console.error('Error:', error));
            } else {
                updateFieldSingleProductInfo(name_product, packaging, unit, {});
            }
        });


        product_code_edit = document.querySelectorAll('.product_code_edit');
        product_code_edit.forEach(product => {
            product.addEventListener('change', function () {
                const valueId = product.getAttribute('data-query-id');
                const name_product = document.getElementById('name_product_view_edit_' + valueId);
                const packaging = document.getElementById('packaging_product_edit_' + valueId);
                const unit = document.getElementById('unit_product_edit_' + valueId);

                if (this.value) {
                    fetch(`/api/product/${this.value}`)
                        .then(response => response.json())
                        .then(data => updateProductInfo(valueId, name_product, packaging, unit, data))
                        .catch(error => console.error('Error:', error));
                } else {
                    updateProductInfo(valueId, name_product, packaging, unit, {});
                }
            });
        });

    </script>
@endpush
