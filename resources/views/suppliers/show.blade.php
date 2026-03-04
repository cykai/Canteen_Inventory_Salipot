@extends('layouts.app')

@section('title', $supplier->supplier_name)

@section('content')
<div class="container-fluid">
    <!-- Page Header with Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back to Suppliers
            </a>
            <h1 class="display-5 fw-bold text-dark mt-3">
                <i class="fas fa-handshake"></i> {{ $supplier->supplier_name }}
            </h1>
        </div>
        <div>
            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Supplier
            </a>
        </div>
    </div>

    <!-- Supplier Details Row -->
    <div class="row g-4 mb-5">
        <!-- Supplier Information Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Supplier Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Supplier Code</label>
                        <p class="fs-5"><code>{{ $supplier->supplier_code }}</code></p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="text-muted small">Email Address</label>
                        <p>
                            <a href="mailto:{{ $supplier->contact_email }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-envelope"></i> {{ $supplier->contact_email }}
                            </a>
                        </p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="text-muted small">Contact Number</label>
                        <p>
                            <a href="tel:{{ $supplier->contact_number }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-phone"></i> {{ $supplier->contact_number }}
                            </a>
                        </p>
                    </div>
                    <hr>
                    <div class="mb-0">
                        <label class="text-muted small">Member Since</label>
                        <p class="fs-6">
                            <i class="fas fa-calendar"></i> {{ $supplier->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Supplied Card -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-box"></i> Products Supplied by This Supplier
                    </h5>
                </div>
                <div class="card-body">
                    @if($supplier->products->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-barcode"></i> Product Code</th>
                                        <th><i class="fas fa-box"></i> Product Name</th>
                                        <th><i class="fas fa-money-bill"></i> Price</th>
                                        <th><i class="fas fa-cubes"></i> Total Supplied</th>
                                        <th><i class="fas fa-arrow-right"></i> View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($supplier->products as $product)
                                    <tr>
                                        <td>
                                            <code>{{ $product->product_code }}</code>
                                        </td>
                                        <td>
                                            <strong>{{ $product->product_name }}</strong>
                                        </td>
                                        <td>
                                            <i class="fas fa-peso-sign"></i> {{ number_format($product->price, 2) }}
                                        </td>
                                        <td>
                                            <span class="badge badge-success">
                                                {{ $product->pivot->quantity ?? 0 }} units
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', $product->id) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-3">This supplier has not supplied any products yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Delivery History -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-history"></i> Delivery History
                    </h5>
                </div>
                <div class="card-body">
                    @if($supplier->stockEntries->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-barcode"></i> Delivery Reference</th>
                                        <th><i class="fas fa-box"></i> Product</th>
                                        <th><i class="fas fa-cubes"></i> Quantity Delivered</th>
                                        <th><i class="fas fa-calendar"></i> Date Delivered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($supplier->stockEntries as $entry)
                                    <tr>
                                        <td>
                                            <code>{{ $entry->delivery_reference }}</code>
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', $entry->product->id) }}">
                                                {{ $entry->product->product_name }}
                                            </a>
                                        </td>
                                        <td>
                                            <strong>{{ $entry->quantity }}</strong> units
                                        </td>
                                        <td>
                                            <small>
                                                {{ $entry->created_at->format('M d, Y H:i A') }}
                                            </small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-3">No delivery history recorded for this supplier.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .col-lg-4, .col-lg-8 {
            margin-bottom: 20px;
        }

        .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 1.8rem !important;
        }
    }
</style>
@endsection
