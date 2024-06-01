@extends('components.app.layouts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('quotation.index') }}">Penawaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
            </ol>
        </nav>

        <form action="{{ route('quotation.update', $quotation->id) }}" method="POST" class="needs-validation form-edit" novalidate>
            @csrf
            @method('PUT')
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

                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible text-black" role="alert">
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach

                    <h5>Formulir Update</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3 g-3">
                        <div class="col-12">
                            <label class="form-label" for="tax">Subject</label>
                            <input type="text" class="form-control" name="subject" autocomplete="off" spellcheck="false" placeholder="Ex: Penawaran Chemical" value="{{ $quotation->subject }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="project_code">Linked To</label>
                            <select class="form-select select-box @error('project_id') is-invalid @enderror" id="project_code" name="project_id" required>
                                <option selected value="">Search code...</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ $quotation->project_id == $project->id ? "selected" : "" }}>{{ $project->project_code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label" for="customer">Name Customer</label>
                            <input type="text" class="form-control" id="customer" readonly disabled placeholder="Choose first reference / linked to" value="{{ $quotation->project->customer->name_customer }}">
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label" for="expedition">Expedition</label>
                            <input type="text" class="form-control" id="expedition" name="expedition" placeholder="Franco / Loco" value="{{ $quotation->expedition }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="validated">Validate</label>
                            <input type="text" class="form-control" name="validated" id="validated" placeholder="14 Hari" title="Validated Quotation" value="{{ $quotation->validated }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="tax">Tax</label>
                            <input type="text" class="form-control" name="tax" id="tax" placeholder="PPN 10%" title="Tax" value="{{ $quotation->tax }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="payment">Payment Term</label>
                            <input type="text" class="form-control" name="payment" id="payment" placeholder="Cash" title="Term of Payment" value="{{ $quotation->payment }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="desc-quo">Description Quotation</label>
                            <textarea class="form-control" name="desc_quo" id="desc-quo" cols="30" rows="10" placeholder="Enter a description quotation" spellcheck="false" required>{{ $quotation->desc_quo }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a type="button" class="btn btn-secondary" href="{{ route('quotation.index') }}">Back</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
            
        </form>
    </div>
@endsection

@push('script')
    <script>
        project_code.addEventListener('change', function() {
            if(this.value) {
                fetch(`/api/project/${this.value}`)
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

