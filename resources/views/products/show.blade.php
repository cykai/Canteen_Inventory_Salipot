@extends('layouts.app')

@section('title', $product->product_name)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back to Products
            </a>
            <h1 class="display-5 fw-bold text-dark mt-3">
                <i class="fas fa-box"></i> {{ $product->product_name }}
            </h1>
        </div>
        <div>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Product
            </a>
        </div>
    </div>


    <div class="row g-4 mb-5">

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Product Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Product Code</label>
                        <p class="fs-5"><code>{{ $product->product_code }}</code></p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="text-muted small">Selling Price</label>
                        <p class="fs-4 fw-bold text-success">
                            <i class="fas fa-peso-sign"></i> {{ number_format($product->price, 2) }}
                        </p>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="text-muted small">Current Stock</label>
                        <p class="fs-4 fw-bold">
                            {{ $product->current_stock }} units
                        </p>
                    </div>
                    <hr>
                    <div class="mb-0">
                        <label class="text-muted small">Stock Status</label>
                        <p>
                            @if($product->current_stock > 10)
                                <span class="badge badge-success">In Stock</span>
                            @elseif($product->current_stock > 0)
                                <span class="badge badge-warning">Low Stock</span>
                            @else
                                <span class="badge badge-danger">Out of Stock</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-handshake"></i> Suppliers for This Product
                    </h5>
                </div>
                <div class="card-body">
                    @if($product->suppliers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-store"></i> Supplier Name</th>
                                        <th><i class="fas fa-envelope"></i> Email</th>
                                        <th><i class="fas fa-phone"></i> Contact</th>
                                        <th><i class="fas fa-cubes"></i> Total Supplied</th>
                                        <th><i class="fas fa-arrow-right"></i> View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->suppliers as $supplier)
                                    <tr>
                                        <td>
                                            <strong>{{ $supplier->supplier_name }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                <code>{{ $supplier->supplier_code }}</code>
                                            </small>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $supplier->contact_email }}">
                                                {{ $supplier->contact_email }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="tel:{{ $supplier->contact_number }}">
                                                {{ $supplier->contact_number }}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">
                                                {{ $supplier->pivot->quantity ?? 0 }} units
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('suppliers.show', $supplier->id) }}" 
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
                            <p class="text-muted mt-3">No suppliers have delivered this product yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Stock History -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-history"></i> Stock Entry History
                    </h5>
                </div>
                <div class="card-body">
                    @if($product->stockEntries->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-barcode"></i> Delivery Reference</th>
                                        <th><i class="fas fa-store"></i> Supplier</th>
                                        <th><i class="fas fa-cubes"></i> Quantity Received</th>
                                        <th><i class="fas fa-calendar"></i> Date Received</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->stockEntries as $entry)
                                    <tr>
                                        <td>
                                            <code>{{ $entry->delivery_reference }}</code>
                                        </td>
                                        <td>
                                            <a href="{{ route('suppliers.show', $entry->supplier->id) }}">
                                                {{ $entry->supplier->supplier_name }}
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
                            <p class="text-muted mt-3">No stock entries recorded for this product.</p>
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
