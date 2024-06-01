@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Menu Products</h4>

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
                                            <input type="text" class="form-control" id="product_code" name="code" placeholder="MEICHEM SC 01" title="Code Product" autocomplete="off" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label" for="product">Name Product</label>
                                            <input type="text" class="form-control" id="product" name="name_product" placeholder="Alkalinity Booster" autocomplete="off" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="packaging">Packaging</label>
                                            <input type="text" class="form-control" id="packaging" name="packaging" placeholder="30 Kg" title="Packaging Product" autocomplete="off" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="unit">Unit</label>
                                            <input type="text" class="form-control" id="unit" name="unit" placeholder="Pail" title="Unit Product" autocomplete="off" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="category_product">Category Product</label>
                                            <input type="text" class="form-control" id="category_product" name="category_product" placeholder="Specialty Chemical" title="Category Product" autocomplete="off" spellcheck="false" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="type_product">Type Data</label>
                                            <select class="form-select select-box" id="type_product" name="type_product" title="Jenis data" required>
                                                <option value="" selected>Choose Type...</option>
                                                <option value="Produk">Produk</option>
                                                <option value="Jasa">Jasa</option>
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
                <table class="table table-bordered table-striped datatable" id="table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Packaging</th>
                            <th>Unit</th>
                            <th>Act.</th>
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
                                                            <h1 class="modal-title fs-5">Informasi Update</h1>
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
                                                                    <input type="text" class="form-control" id="packaging" name="packaging" placeholder="Ex: 30 kg" title="Packaging Produk" value="{{ $product->packaging }}" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="unit">Unit</label>
                                                                    <input type="text" class="form-control" id="unit" name="unit" placeholder="Ex: Pill" title="Unit Produk" value="{{ $product->unit }}" required>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="category_product">Category Product</label>
                                                                    <input type="text" class="form-control" id="category_product" name="category_product" placeholder="Specialty Chemical" title="Category Product" value="{{ $product->category_product }}" autocomplete="off" spellcheck="false" required>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="type_product">Type Data</label>
                                                                    <select class="form-select select-box" id="type_product" name="type_product" title="Type data" required>
                                                                        <option value="" selected>Choose Type...</option>
                                                                        <option value="Produk" {{ $product->type_product == "Produk" ? "selected" : "" }}>Produk</option>
                                                                        <option value="Jasa" {{ $product->type_product == "Jasa" ? "selected" : "" }}>Jasa</option>
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