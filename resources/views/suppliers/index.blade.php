@extends('layouts.app')

@section('title', 'Suppliers')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold text-dark">
                <i class="fas fa-handshake"></i> Suppliers
            </h1>
            <p class="text-muted">Manage supplier information and relationships</p>
        </div>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus"></i> Add New Supplier
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('suppliers.index') }}" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Search Supplier</label>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search by name or code..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-6">
                    <div style="margin-top: 32px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Suppliers Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-table"></i> Suppliers List</h5>
        </div>
        <div class="card-body">
            @if($suppliers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="fas fa-barcode"></i> Supplier Code</th>
                                <th><i class="fas fa-store"></i> Supplier Name</th>
                                <th><i class="fas fa-envelope"></i> Email</th>
                                <th><i class="fas fa-phone"></i> Contact Number</th>
                                <th><i class="fas fa-box"></i> Products</th>
                                <th><i class="fas fa-actions"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suppliers as $supplier)
                            <tr>
                                <td>
                                    <code>{{ $supplier->supplier_code }}</code>
                                </td>
                                <td>
                                    <strong>{{ $supplier->supplier_name }}</strong>
                                </td>
                                <td>
                                    <a href="mailto:{{ $supplier->contact_email }}" class="text-decoration-none">
                                        <i class="fas fa-envelope"></i> {{ $supplier->contact_email }}
                                    </a>
                                </td>
                                <td>
                                    <a href="tel:{{ $supplier->contact_number }}" class="text-decoration-none">
                                        <i class="fas fa-phone"></i> {{ $supplier->contact_number }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $supplier->products->count() }} products
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('suppliers.show', $supplier->id) }}" 
                                           class="btn btn-sm btn-info" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('suppliers.edit', $supplier->id) }}" 
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" 
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
                    {{ $suppliers->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">No suppliers found. <a href="{{ route('suppliers.create') }}">Add your first supplier</a></p>
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

        .d-flex {
            flex-direction: column;
        }
    }
</style>
@endsection
