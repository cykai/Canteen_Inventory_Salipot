@extends('layouts.app')

@section('title', 'Stock Entries')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold text-dark">
                <i class="fas fa-chart-bar"></i> Stock Entries
            </h1>
            <p class="text-muted">Manage product stock deliveries</p>
        </div>
        <a href="{{ route('stock-entries.create') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus"></i> New Stock Entry
        </a>
    </div>

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('stock-entries.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Filter by Product</label>
                    <select name="product_id" class="form-select">
                        <option value="">All Products</option>
                        @foreach($products ?? [] as $product)
                            <option value="{{ $product->id }}" @if(request('product_id') == $product->id) selected @endif>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Filter by Supplier</label>
                    <select name="supplier_id" class="form-select">
                        <option value="">All Suppliers</option>
                        @foreach($suppliers ?? [] as $supplier)
                            <option value="{{ $supplier->id }}" @if(request('supplier_id') == $supplier->id) selected @endif>
                                {{ $supplier->supplier_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div style="margin-top: 32px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('stock-entries.index') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Stock Entries Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-list"></i> Stock Entry Records</h5>
        </div>
        <div class="card-body">
            @if($stockEntries->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="fas fa-barcode"></i> Delivery Reference</th>
                                <th><i class="fas fa-box"></i> Product</th>
                                <th><i class="fas fa-store"></i> Supplier</th>
                                <th><i class="fas fa-cubes"></i> Quantity</th>
                                <th><i class="fas fa-calendar"></i> Date Received</th>
                                <th><i class="fas fa-actions"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stockEntries as $entry)
                            <tr>
                                <td>
                                    <code>{{ $entry->delivery_reference }}</code>
                                </td>
                                <td>
                                    <strong>
                                        <a href="{{ route('products.show', $entry->product->id) }}" class="text-decoration-none">
                                            {{ $entry->product->product_name }}
                                        </a>
                                    </strong>
                                    <br>
                                    <small class="text-muted">{{ $entry->product->product_code }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('suppliers.show', $entry->supplier->id) }}" class="text-decoration-none">
                                        {{ $entry->supplier->supplier_name }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge badge-success">
                                        {{ $entry->quantity }} units
                                    </span>
                                </td>
                                <td>
                                    <small>{{ $entry->created_at->format('M d, Y H:i A') }}</small>
                                </td>
                                <td>
                                    <form action="{{ route('stock-entries.destroy', $entry->id) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure? This will decrease product stock!')" 
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $stockEntries->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">No stock entries found. <a href="{{ route('stock-entries.create') }}">Create your first stock entry</a></p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .btn-lg {
            width: 100%;
            margin-top: 10px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .row {
            flex-direction: column;
        }

        .col-md-4, .col-md-6 {
            width: 100%;
        }

        .d-flex {
            flex-direction: column;
        }
    }
</style>
@endsection
