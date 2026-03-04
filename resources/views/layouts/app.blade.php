<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Canteen Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-brand i {
            margin-right: 8px;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: #2d3436;
            min-height: 100vh;
            padding: 20px 0;
            position: fixed;
            width: 250px;
            left: 0;
            top: 60px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar a {
            color: #dfe6e9;
            text-decoration: none;
            display: block;
            padding: 14px 20px;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .sidebar a:hover {
            background-color: #353d45;
            border-left-color: #667eea;
            color: #fff;
            padding-left: 25px;
        }

        .sidebar a.active {
            background-color: #667eea;
            border-left-color: #667eea;
            color: #fff;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 30px 20px;
            min-height: calc(100vh - 60px);
        }

        /* Card Styles */
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px 8px 0 0;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 8px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Badge Styles */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-success {
            background-color: #00b894;
            color: white;
        }

        .badge-danger {
            background-color: #d63031;
            color: white;
        }

        .badge-warning {
            background-color: #fdcb6e;
            color: #333;
        }

        /* Table Styles */
        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            font-weight: 600;
            padding: 15px;
        }

        .table tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
        }

        /* Form Styles */
        .form-control, .form-select {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        /* Dashboard Stats */
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }

        .stat-card i {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
        }

        .stat-card .label {
            color: #666;
            font-size: 0.95rem;
        }

        /* Pagination */
        .pagination {
            margin-top: 20px;
        }

        .pagination .page-link {
            color: #667eea;
            border: 1px solid #ddd;
        }

        .pagination .page-link:hover {
            background-color: #667eea;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: #667eea;
            border-color: #667eea;
        }

        /* Responsive Mobile */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                top: 0;
                display: flex;
                flex-wrap: wrap;
                padding: 10px 0;
            }

            .sidebar a {
                flex: 1 1 25%;
                padding: 10px;
                text-align: center;
                border-left: none;
                border-bottom: 3px solid transparent;
                font-size: 0.85rem;
            }

            .sidebar a:hover, .sidebar a.active {
                border-left: none;
                border-bottom-color: #667eea;
                background-color: #353d45;
            }

            .main-content {
                margin-left: 0;
                padding: 15px 10px;
            }

            .card {
                margin-bottom: 15px;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-card i {
                font-size: 2rem;
            }

            .stat-card .number {
                font-size: 1.5rem;
            }

            .table {
                font-size: 0.85rem;
            }

            .table thead th, .table tbody td {
                padding: 8px 10px;
            }

            .btn-sm {
                padding: 4px 8px;
                font-size: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .main-content {
                padding: 10px;
            }

            .sidebar a {
                flex: 1 1 50%;
            }

            .stat-card {
                padding: 12px;
            }

            .stat-card i {
                font-size: 1.8rem;
            }

            .stat-card .number {
                font-size: 1.3rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-box"></i> Canteen Inventory Manager
            </a>
            <span class="navbar-text text-white d-none d-md-inline">
                <i class="fas fa-user-circle"></i> Admin Panel
            </span>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <a href="{{ route('home') }}" class="@if(Route::currentRouteName() === 'home') active @endif">
                <i class="fas fa-home"></i> <span class="d-none d-md-inline">Dashboard</span>
            </a>
            <a href="{{ route('products.index') }}" class="@if(str_contains(Route::currentRouteName(), 'products')) active @endif">
                <i class="fas fa-list"></i> <span class="d-none d-md-inline">Products</span>
            </a>
            <a href="{{ route('suppliers.index') }}" class="@if(str_contains(Route::currentRouteName(), 'suppliers')) active @endif">
                <i class="fas fa-handshake"></i> <span class="d-none d-md-inline">Suppliers</span>
            </a>
            <a href="{{ route('stock-entries.index') }}" class="@if(str_contains(Route::currentRouteName(), 'stock')) active @endif">
                <i class="fas fa-chart-bar"></i> <span class="d-none d-md-inline">Stock</span>
            </a>
        </aside>

        <!-- Main Content -->
        <main class="main-content flex-grow-1">
            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-circle"></i> Validation Error!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Success Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-dismiss alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    </script>
    @yield('scripts')
</body>
</html>
