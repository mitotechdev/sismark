@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Menu Products</h4>

        @if ($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible text-black" role="alert">
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

        <div class="card mb-4">
            <div class="card-header">
                <h5>Data Products</h5>
                @can('create-product')
                <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addProduct">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="ms-1">Add Product</span>
                </button>
                
                <!-- Modal -->
                <form action="{{ route('product.store') }}" novalidate method="POST" class="form-create" id="form_add_item">
                    @csrf
                    @method('POST')
                    <div class="modal fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Information Product</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3 g-3">
                                        <div class="col-md-4">
                                            <label class="form-label" for="product_code">Product Code</label>
                                            <input type="text" class="form-control" id="product_code" name="code" placeholder="Ex: MEICHEM SC 01" title="Kode Produk" autocomplete="off" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label" for="product">Name Product</label>
                                            <input type="text" class="form-control" id="product" name="name_product" placeholder="Ex: Alkalinity Booster" autocomplete="off" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="packaging">Packaging</label>
                                            <input type="text" class="form-control" id="packaging" name="packaging" placeholder="Ex: 25 kg/zak" title="Kemasan Produk" autocomplete="off" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="unit">Unit</label>
                                            <input type="text" class="form-control" id="unit" name="unit" placeholder="Ex: Pill" title="Satuan Produk" autocomplete="off" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="category_product">Category Product</label>
                                            <select class="form-select select-box" id="category_product" name="category_product_id" title="Kategori Produk" required>
                                                <option value="" selected>Select Category...</option>
                                                <option value="Specialty Chemical">Specialty Chemical</option>
                                                <option value="General Chemical">General Chemical</option>
                                                <option value="Cleaning Boiler">Cleaning Boiler</option>
                                                <option value="WTP Consultant">WTP Consultant</option>
                                                <option value="Training Knowledge Cleaning">Training Knowledge Cleaning</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="type_product">Type Data</label>
                                            <select class="form-select select-box" id="type_product" name="type_product_id" title="Jenis data" required>
                                                <option value="" selected>Choose Type...</option>
                                                <option value="Chemical Product">Chemical Product</option>
                                                <option value="Services">Services</option>
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
                @endcan
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped datatable" id="table" style="width:100%">
                    <thead>
                        <tr>
                            <th data-priority='1' style="width: 5%">#</th>
                            <th data-priority='2'>Code</th>
                            <th data-priority="4">Name</th>
                            <th>Packaging</th>
                            <th>Unit</th>
                            <th data-priority='3'>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->packaging }}</td>
                                <td>{{ $product->unit }}</td>
                                <td>
                                    <div class="d-flex">
                                        @can('create-product', $product)
                                        <button type="button" class="btn btn-sm btn-outline-warning me-1" data-bs-toggle="modal" data-bs-target="#updateProduct-{{ $product->id }}">
                                            <i class='bx bxs-edit bx-xs'></i>
                                        </button>
                                        
                                        <form action="{{ route('product.update', $product->id) }}" method="POST" class="needs-validation">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal fade" id="updateProduct-{{ $product->id }}" tabindex="-1" aria-labelledby="updateProduct-{{$product->id}}" aria-hidden="true">
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
                                                                    <input type="text" class="form-control" id="product_code" name="code" placeholder="Ex: MEICHEM SC 01" title="Kode Produk" value="{{ $product->code }}" required>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <label class="form-label" for="product">Name Product</label>
                                                                    <input type="text" class="form-control" id="product" name="name_product" placeholder="Ex: Alkalinity Booster" value="{{ $product->name }}" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="packaging">Packaging</label>
                                                                    <input type="text" class="form-control" id="packaging" name="packaging" placeholder="Ex: 25 kg/zak" title="Kemasan Produk" value="{{ $product->packaging }}" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="unit">Unit</label>
                                                                    <input type="text" class="form-control" id="unit" name="unit" placeholder="Ex: Pill" title="Satuan Produk" value="{{ $product->unit }}" required>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="category_product">Category Product</label>
                                                                    <select class="form-select select-box" id="category_product" name="category_product_id" title="Kategori Produk" required>
                                                                        <option value="" selected>Select Category...</option>
                                                                        <option value="Specialty Chemical" {{ $product->category_product_id == "Specialty Chemical" ? "selected" : "" }} >Specialty Chemical</option>
                                                                        <option value="General Chemical" {{ $product->category_product_id == "General Chemical" ? "selected" : "" }} >General Chemical</option>
                                                                        <option value="Cleaning Boiler" {{ $product->category_product_id == "Cleaning Boiler" ? "selected" : "" }} >Cleaning Boiler</option>
                                                                        <option value="WTP Consultant" {{ $product->category_product_id == "WTP Consultant" ? "selected" : "" }} >WTP Consultant</option>
                                                                        <option value="Training Knowledge Cleaning" {{ $product->category_product_id == "Training Knowledge Cleaning" ? "selected" : "" }} >Training Knowledge Cleaning</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="type_product">Type Data</label>
                                                                    <select class="form-select select-box" id="type_product" name="type_product_id" title="Jenis data" required>
                                                                        <option value="" selected>Choose Type...</option>
                                                                        <option value="Chemical Product" {{ $product->type_product_id == "Chemical Product" ? "selected" : "" }} >Chemical Product</option>
                                                                        <option value="Services" {{ $product->type_product_id == "Services" ? "selected" : "" }} >Services</option>
                                                                    </select>
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

                                        @can('delete-product', $product)
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="needs-validation form-destroy">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class='bx bxs-trash-alt bx-xs'></i>
                                            </button>
                                        </form>
                                        @endcan
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
