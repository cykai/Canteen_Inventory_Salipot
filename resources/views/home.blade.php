@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="display-5 fw-bold text-dark">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </h1>
        <p class="text-muted">Welcome to Canteen Inventory Management System</p>
    </div>

    <!-- Statistics Cards Row -->
    <div class="row g-4 mb-5">
        <!-- Total Products Card -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stat-card">
                <i class="fas fa-box" style="color: #667eea;"></i>
                <div class="number">{{ $totalProducts ?? 0 }}</div>
                <div class="label">Total Products</div>
            </div>
        </div>

        <!-- Total Suppliers Card -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stat-card">
                <i class="fas fa-handshake" style="color: #764ba2;"></i>
                <div class="number">{{ $totalSuppliers ?? 0 }}</div>
                <div class="label">Total Suppliers</div>
            </div>
        </div>

        <!-- Total Stock Entries Card -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stat-card">
                <i class="fas fa-chart-bar" style="color: #00b894;"></i>
                <div class="number">{{ $totalStockEntries ?? 0 }}</div>
                <div class="label">Stock Entries</div>
            </div>
        </div>

        <!-- Low Stock Alert Card -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="stat-card">
                <i class="fas fa-exclamation-triangle" style="color: #d63031;"></i>
                <div class="number">{{ $lowStockCount ?? 0 }}</div>
                <div class="label">Low Stock Items</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="row g-4 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{ route('products.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus"></i> Add Product
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{ route('suppliers.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus"></i> Add Supplier
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{ route('stock-entries.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus"></i> New Stock Entry
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{ route('products.index') }}" class="btn btn-primary w-100">
                                <i class="fas fa-eye"></i> View All Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Stock Entries -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Recent Stock Entries</h5>
                </div>
                <div class="card-body">
                    @if(isset($recentStockEntries) && $recentStockEntries->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-box"></i> Product</th>
                                        <th><i class="fas fa-handshake"></i> Supplier</th>
                                        <th><i class="fas fa-cubes"></i> Quantity</th>
                                        <th><i class="fas fa-barcode"></i> Reference</th>
                                        <th><i class="fas fa-calendar"></i> Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentStockEntries as $entry)
                                    <tr>
                                        <td>
                                            <a href="{{ route('products.show', $entry->product->id) }}" class="text-decoration-none">
                                                {{ $entry->product->product_name }}
                                            </a>
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
                                        <td><code>{{ $entry->delivery_reference }}</code></td>
                                        <td>{{ $entry->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3">No stock entries yet. <a href="{{ route('stock-entries.create') }}">Create one now</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
