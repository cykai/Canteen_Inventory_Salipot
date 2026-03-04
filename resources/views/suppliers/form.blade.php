@extends('layouts.app')

@section('title', isset($supplier) ? 'Edit Supplier' : 'Create Supplier')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="display-5 fw-bold text-dark">
            <i class="fas fa-{{ isset($supplier) ? 'edit' : 'plus' }}"></i>
            {{ isset($supplier) ? 'Edit Supplier' : 'Create New Supplier' }}
        </h1>
        <p class="text-muted">
            {{ isset($supplier) ? 'Update supplier information' : 'Add a new supplier to your network' }}
        </p>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        {{ isset($supplier) ? 'Update Supplier Details' : 'Supplier Information' }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ isset($supplier) ? route('suppliers.update', $supplier->id) : route('suppliers.store') }}" 
                          method="POST" class="needs-validation" novalidate>
                        @csrf
                        @if(isset($supplier))
                            @method('PUT')
                        @endif

                        <!-- Supplier Code -->
                        <div class="mb-4">
                            <label for="supplier_code" class="form-label">
                                <i class="fas fa-barcode"></i> Supplier Code *
                            </label>
                            <input type="text" 
                                   class="form-control @error('supplier_code') is-invalid @enderror" 
                                   id="supplier_code" 
                                   name="supplier_code" 
                                   placeholder="e.g., SUP001"
                                   value="{{ old('supplier_code', $supplier->supplier_code ?? '') }}"
                                   @if(isset($supplier)) disabled @endif
                                   required>
                            @error('supplier_code')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Unique identifier for the supplier</small>
                        </div>

                        <!-- Supplier Name -->
                        <div class="mb-4">
                            <label for="supplier_name" class="form-label">
                                <i class="fas fa-store"></i> Supplier Name *
                            </label>
                            <input type="text" 
                                   class="form-control @error('supplier_name') is-invalid @enderror" 
                                   id="supplier_name" 
                                   name="supplier_name" 
                                   placeholder="Enter supplier company name"
                                   value="{{ old('supplier_name', $supplier->supplier_name ?? '') }}"
                                   required>
                            @error('supplier_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact Email -->
                        <div class="mb-4">
                            <label for="contact_email" class="form-label">
                                <i class="fas fa-envelope"></i> Contact Email *
                            </label>
                            <input type="email" 
                                   class="form-control @error('contact_email') is-invalid @enderror" 
                                   id="contact_email" 
                                   name="contact_email" 
                                   placeholder="supplier@example.com"
                                   value="{{ old('contact_email', $supplier->contact_email ?? '') }}"
                                   required>
                            @error('contact_email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Must be a valid email address</small>
                        </div>

                        <!-- Contact Number -->
                        <div class="mb-4">
                            <label for="contact_number" class="form-label">
                                <i class="fas fa-phone"></i> Contact Number *
                            </label>
                            <input type="tel" 
                                   class="form-control @error('contact_number') is-invalid @enderror" 
                                   id="contact_number" 
                                   name="contact_number" 
                                   placeholder="+63 9XXXXXXXXX"
                                   value="{{ old('contact_number', $supplier->contact_number ?? '') }}"
                                   required>
                            @error('contact_number')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Contact phone number with country code</small>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> 
                                {{ isset($supplier) ? 'Update Supplier' : 'Create Supplier' }}
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
                    <h6 class="fw-bold">Supplier Code</h6>
                    <p class="small text-muted">Must be unique and cannot be changed. Use codes like SUP001, SUPP001, etc.</p>

                    <hr>

                    <h6 class="fw-bold">Supplier Name</h6>
                    <p class="small text-muted">Enter the full company name. Example: ABC Trading, Fresh Foods Inc., etc.</p>

                    <hr>

                    <h6 class="fw-bold">Contact Email</h6>
                    <p class="small text-muted">Must be a valid email address. This will be used for communication.</p>

                    <hr>

                    <h6 class="fw-bold">Contact Number</h6>
                    <p class="small text-muted">Include the country code. Example: +63 9171234567</p>

                    <hr>

                    <div class="alert alert-info small">
                        <i class="fas fa-info-circle"></i> Email and phone must be unique for each supplier.
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
