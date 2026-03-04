@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold text-dark">
                <i class="fas fa-list"></i> Products
            </h1>
            <p class="text-muted">Manage canteen products and inventory</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('products.index') }}" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Search Product</label>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search by name or code..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-6">
                    <div style="margin-top: 32px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-table"></i> Products List</h5>
        </div>
        <div class="card-body">
            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="fas fa-barcode"></i> Product Code</th>
                                <th><i class="fas fa-box"></i> Product Name</th>
                                <th><i class="fas fa-money-bill"></i> Price</th>
                                <th><i class="fas fa-warehouse"></i> Current Stock</th>
                                <th><i class="fas fa-signal"></i> Status</th>
                                <th><i class="fas fa-actions"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    <code>{{ $product->product_code }}</code>
                                </td>
                                <td>
                                    <strong>{{ $product->product_name }}</strong>
                                </td>
                                <td>
                                    <i class="fas fa-dollar-sign"></i> {{ number_format($product->price, 2) }}
                                </td>
                                <td>
                                    <strong>{{ $product->current_stock }}</strong> units
                                </td>
                                <td>
                                    @if($product->current_stock > 10)
                                        <span class="badge badge-success">In Stock</span>
                                    @elseif($product->current_stock > 0)
                                        <span class="badge badge-warning">Low Stock</span>
                                    @else
                                        <span class="badge badge-danger">Out of Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('products.show', $product->id) }}" 
                                           class="btn btn-sm btn-info" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}" 
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" 
                                              method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure?')" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">No products found. <a href="{{ route('products.create') }}">Create your first product</a></p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .btn-group {
        gap: 5px;
    }

    .btn-group .btn {
        margin-right: 2px;
    }

    @media (max-width: 768px) {
        .btn-group {
            flex-wrap: wrap;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .btn-lg {
            width: 100%;
            margin-top: 10px;
        }
    }
</style>
@endsection
