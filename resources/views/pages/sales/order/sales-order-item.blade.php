@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pb-3"><span class="text-muted fw-light">Order Detail</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('sales-order.index') }}">Sales Order</a>
                </li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>

        <div class="card">
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

                <h5>List Item</h5>
                <div class="d-flex align-items-center justify-content-between">
                    @if ($salesOrder->approval->id == 1)
                    @can('create-sales-order-item')
                    <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addItem">
                        <i class='bx bxs-plus-circle'></i>
                        <span class="ms-1">Add Item</span>
                    </button>
                    
                    <!-- Modal -->
                    <form action="{{ route('sales-order-item.store') }}" method="POST" class="needs-validation form-create" id="form_create">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="sales_order_id" value="{{ $salesOrder->id }}">
                        <div class="modal fade" id="addItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Information Item</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Name Product</label>
                                            <div class="col-sm-9">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <select class="form-select select-box" name="product_id" id="name_product" title="Nama Produk/Item" required>
                                                            <option value="" selected>Select Item...</option>
                                                            @foreach ($products as $product)
                                                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? "selected" : "" }}>{{ $product->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control" title="Kemasan" id="packaging" readonly placeholder="Please select product first">
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control" title="Satuan" id="unit" readonly placeholder="Please select product first">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="qty" class="col-sm-3 col-form-label">QTY</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" name="qty" id="qty" title="QTY Item" oninput="calculateOnInput()" placeholder="QTY" value="{{ old('qty') }}" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="price" class="col-sm-3 col-form-label">Price</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="number" class="form-control" step=".01" placeholder="0.00" oninput="calculateOnInput()" name="price" id="price" title="Harga satuan item" value="{{ old('price') }}" required>
                                                </div>
                                                <small>Masukan harga DPP produk, untuk kalkulasi {{ $salesOrder->tax->name }} di akhir.</small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="discount" class="col-sm-3 col-form-label">Discount</label>
                                            <div class="col-sm-9">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="number" class="form-control" step=".01" placeholder="0.00" name="discount" oninput="calculateOnInput()" id="discount" title="Diskon item" value="{{ old('discount') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label fw-bold">Grand Total</label>
                                            <div class="col-sm-9">
                                                <div class="input-group mb-3">
                                                    <input type="text" id="show_grand_total" class="form-control fw-bold" autocomplete="off" spellcheck="false" readonly>
                                                    <input type="hidden" value="" name="total_amount" id="total_amount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <div class="input-group mb-3">
                                                    <textarea class="form-control" name="desc" id="desc" rows="4" required placeholder="Deskripsikan jika jasa. Abaikan bagian ini dengan tanda (-) jika tidak ada."></textarea>
                                                </div>
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
                    @endif

                    @can('submit-sales-order-item')
                    @if ( $salesOrder->sales_order_items->isNotEmpty() && $salesOrder->approval->id == 1)
                        <form action="{{ route('sales-order.status', $salesOrder->id) }}" method="POST" class="form-edit">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-outline-success" type="submit">Open Request</button>
                        </form>
                    @endif
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>QTY</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Total Amount</th>
                            <th>Desc</th>
                            <th>Act.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesOrder->sales_order_items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->product->unit }}</td>
                                <td>{{ 'Rp  '. number_format($item->price, 2, ',', '.') }}</td>
                                <td>{{ 'Rp  '. number_format($item->total_amount, 2, ',', '.') }}</td>
                                <td>
                                    {{ $item->desc }}
                                </td>
                                <td>
                                    @if ($salesOrder->approval->id == 1)
                                    @can('delete-sales-order-item')
                                    <form action="{{ route('sales-order-item.destroy', $item->id) }}" method="POST" class="needs-validation form-destroy">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class='bx bxs-trash-alt bx-bxs'></i>
                                        </button>
                                    </form>
                                    @endcan
                                    @else
                                        <div><i class='bx bx-lock-alt'></i></div>
                                    @endif
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
        let nameProduct = document.getElementById('name_product');
        function updateFieldProductInfo(packaging, unit, data) {
            packaging.value = data.packaging || '';
            unit.value = data.unit || '';
        }

        function calculateOnInput() {
            const currentQty = parseFloat(qty.value || 0) || 1;
            const currentPrice = parseFloat(price.value || 0);
            const currentDiscount = parseFloat(discount.value || 0);
            const totalAmount = currentQty * (currentPrice - currentDiscount);
            // console.log(currentQty);

            show_grand_total.value = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(totalAmount);

            total_amount.value = totalAmount; // value for backend
        }

        if(nameProduct)
        {
            nameProduct.addEventListener('change', function() {
                if(this.value) {
                    fetch(`/api/product/${this.value}`)
                        .then( response => response.json() )
                        .then( data => updateFieldProductInfo(packaging, unit, data) )
                        .catch( error => console.error('Error:', error) );
                } else {
                    updateFieldProductInfo(packaging, unit, {});
                }
            })
        }
    </script>
@endpush
