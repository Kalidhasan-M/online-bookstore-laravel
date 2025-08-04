@extends('layouts.app')

@section('title', 'Admin Dashboard - Online Book Store')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">
            <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
        </h1>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $totalBooks }}</h4>
                        <p class="mb-0">Total Books</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-books fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $availableBooks }}</h4>
                        <p class="mb-0">Available Books</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $totalCategories }}</h4>
                        <p class="mb-0">Categories</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-tags fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $totalUsers }}</h4>
                        <p class="mb-0">Users</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.books.create') }}" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-2"></i>Add New Book
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-info w-100">
                            <i class="fas fa-tag me-2"></i>Add Category
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-list me-2"></i>Manage Books
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-cogs me-2"></i>Manage Categories
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Books -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Recent Books</h5>
                <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                @if($recentBooks->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBooks as $book)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.books.show', $book) }}" class="text-decoration-none">
                                            {{ $book->title }}
                                        </a>
                                    </td>
                                    <td>{{ $book->author }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $book->category->name }}</span>
                                    </td>
                                    <td>${{ number_format($book->price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">No books found.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Low Stock Alert -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Low Stock Alert</h5>
                <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-outline-warning">View All</a>
            </div>
            <div class="card-body">
                @if($lowStockBooks->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowStockBooks as $book)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.books.edit', $book) }}" class="text-decoration-none">
                                            {{ $book->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">{{ $book->stock_quantity }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">All books have sufficient stock.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 