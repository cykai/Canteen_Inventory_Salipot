@extends('layouts.app')

@section('title', 'New Stock Entry')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="display-5 fw-bold text-dark">
            <i class="fas fa-plus"></i> New Stock Entry
        </h1>
        <p class="text-muted">Record a new product delivery from supplier</p>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i> Stock Entry Details
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('stock-entries.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <!-- Product Selection -->
                        <div class="mb-4">
                            <label for="product_id" class="form-label">
                                <i class="fas fa-box"></i> Product *
                            </label>
                            <select class="form-select @error('product_id') is-invalid @enderror" 
                                    id="product_id" 
                                    name="product_id"
                                    required>
                                <option value="">-- Select a Product --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" @if(old('product_id') == $product->id) selected @endif>
                                        {{ $product->product_name }} ({{ $product->product_code }})
                                        - Stock: {{ $product->current_stock }} units
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Choose the product being delivered</small>
                        </div>

                        <!-- Supplier Selection -->
                        <div class="mb-4">
                            <label for="supplier_id" class="form-label">
                                <i class="fas fa-store"></i> Supplier *
                            </label>
                            <select class="form-select @error('supplier_id') is-invalid @enderror" 
                                    id="supplier_id" 
                                    name="supplier_id"
                                    required>
                                <option value="">-- Select a Supplier --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" @if(old('supplier_id') == $supplier->id) selected @endif>
                                        {{ $supplier->supplier_name }} ({{ $supplier->supplier_code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Choose the supplier providing the product</small>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-4">
                            <label for="quantity" class="form-label">
                                <i class="fas fa-cubes"></i> Quantity *
                            </label>
                            <input type="number" 
                                   class="form-control @error('quantity') is-invalid @enderror" 
                                   id="quantity" 
                                   name="quantity" 
                                   placeholder="0"
                                   min="1"
                                   step="1"
                                   value="{{ old('quantity') }}"
                                   required>
                            @error('quantity')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Must be greater than 0</small>
                        </div>

                        <!-- Delivery Reference -->
                        <div class="mb-4">
                            <label for="delivery_reference" class="form-label">
                                <i class="fas fa-barcode"></i> Delivery Reference *
                            </label>
                            <input type="text" 
                                   class="form-control @error('delivery_reference') is-invalid @enderror" 
                                   id="delivery_reference" 
                                   name="delivery_reference" 
                                   placeholder="e.g., DEL-2024-001"
                                   value="{{ old('delivery_reference') }}"
                                   required>
                            @error('delivery_reference')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Unique reference number for this delivery</small>
                        </div>

                        <!-- Summary Alert -->
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Note:</strong> When you submit this form, the product stock will be automatically updated with the quantity you enter.
                        </div>

                        <!-- Form Actions -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                            <a href="{{ route('stock-entries.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Stock Entry
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Help Sidebar -->
        <div class="col-lg-4">
            <div class="card bg-light">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Help & Tips</h5>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold">What is a Stock Entry?</h6>
                    <p class="small text-muted">A stock entry records when a product is delivered to your canteen from a supplier. This automatically updates the product's current stock.</p>

                    <hr>

                    <h6 class="fw-bold">Product</h6>
                    <p class="small text-muted">Select the product you are receiving. Only created products appear in this list.</p>

                    <hr>

                    <h6 class="fw-bold">Supplier</h6>
                    <p class="small text-muted">Select the supplier who is delivering this product.</p>

                    <hr>

                    <h6 class="fw-bold">Quantity</h6>
                    <p class="small text-muted">Enter the number of units being delivered. This amount will be added to the product's current stock.</p>

                    <hr>

                    <h6 class="fw-bold">Delivery Reference</h6>
                    <p class="small text-muted">Enter a unique reference code for this delivery. Example: DEL-2024-001, SUPP-12345, etc. Cannot be duplicated.</p>

                    <hr>

                    <div class="alert alert-warning small">
                        <i class="fas fa-exclamation-triangle"></i> <strong>Important:</strong> Once created, stock entries cannot be edited. You can only delete them (which reverses the stock increase).
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .col-lg-8, .col-lg-4 {
            margin-bottom: 20px;
        }

        .d-grid {
            display: grid;
        }

        .d-grid button, .d-grid a {
            width: 100%;
        }
    }

    .form-select:focus, .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .invalid-feedback {
        color: #d63031;
        font-size: 0.85rem;
        margin-top: 5px;
    }

    .alert {
        border-radius: 8px;
    }
</style>
@endsection
