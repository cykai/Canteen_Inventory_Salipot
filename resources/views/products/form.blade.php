@extends('layouts.app')

@section('title', isset($product) ? 'Edit Product' : 'Create Product')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="display-5 fw-bold text-dark">
            <i class="fas fa-{{ isset($product) ? 'edit' : 'plus' }}"></i>
            {{ isset($product) ? 'Edit Product' : 'Create New Product' }}
        </h1>
        <p class="text-muted">
            {{ isset($product) ? 'Update product information' : 'Add a new product to inventory' }}
        </p>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        {{ isset($product) ? 'Update Product Details' : 'Product Information' }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" 
                          method="POST" class="needs-validation" novalidate>
                        @csrf
                        @if(isset($product))
                            @method('PUT')
                        @endif

                        <!-- Product Code -->
                        <div class="mb-4">
                            <label for="product_code" class="form-label">
                                <i class="fas fa-barcode"></i> Product Code *
                            </label>
                            <input type="text" 
                                   class="form-control @error('product_code') is-invalid @enderror" 
                                   id="product_code" 
                                   name="product_code" 
                                   placeholder="e.g., PROD001"
                                   value="{{ old('product_code', $product->product_code ?? '') }}"
                                   @if(isset($product)) disabled @endif
                                   required>
                            @error('product_code')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Unique identifier for the product</small>
                        </div>

                        <!-- Product Name -->
                        <div class="mb-4">
                            <label for="product_name" class="form-label">
                                <i class="fas fa-box"></i> Product Name *
                            </label>
                            <input type="text" 
                                   class="form-control @error('product_name') is-invalid @enderror" 
                                   id="product_name" 
                                   name="product_name" 
                                   placeholder="Enter product name"
                                   value="{{ old('product_name', $product->product_name ?? '') }}"
                                   required>
                            @error('product_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="form-label">
                                <i class="fas fa-money-bill"></i> Price (₱) *
                            </label>
                            <input type="number" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   id="price" 
                                   name="price" 
                                   placeholder="0.00"
                                   step="0.01"
                                   min="0"
                                   value="{{ old('price', $product->price ?? '') }}"
                                   required>
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Stock (Read-only) -->
                        @if(isset($product))
                        <div class="mb-4">
                            <label for="current_stock" class="form-label">
                                <i class="fas fa-warehouse"></i> Current Stock
                            </label>
                            <input type="number" 
                                   class="form-control" 
                                   id="current_stock" 
                                   name="current_stock" 
                                   value="{{ $product->current_stock }}"
                                   disabled>
                            <small class="form-text text-muted">Stock is updated automatically through stock entries</small>
                        </div>
                        @endif

                        <!-- Form Actions -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> 
                                {{ isset($product) ? 'Update Product' : 'Create Product' }}
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
                    <h6 class="fw-bold">Product Code</h6>
                    <p class="small text-muted">Must be unique and cannot be changed after creation. Use codes like PROD001, DRINK001, etc.</p>

                    <hr>

                    <h6 class="fw-bold">Product Name</h6>
                    <p class="small text-muted">Enter the full product name. Example: Fried Rice, Orange Juice, etc.</p>

                    <hr>

                    <h6 class="fw-bold">Price</h6>
                    <p class="small text-muted">Enter the selling price of the product in Philippine Peso (₱).</p>

                    <hr>

                    <h6 class="fw-bold">Stock Management</h6>
                    <p class="small text-muted">Stock is automatically updated when you create stock entries. You cannot manually edit stock.</p>
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

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .invalid-feedback {
        color: #d63031;
        font-size: 0.85rem;
        margin-top: 5px;
    }
</style>
@endsection
