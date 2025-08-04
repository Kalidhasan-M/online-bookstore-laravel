@extends('layouts.app')

@section('title', 'View Category - Admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-eye me-2"></i>View Category</h1>
            <div>
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary me-2">
                    <i class="fas fa-edit me-2"></i>Edit Category
                </a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Categories
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-tag me-2"></i>Category Details</h5>
            </div>
            <div class="card-body">
                <h2>{{ $category->name }}</h2>
                <p class="text-muted">Slug: <code>{{ $category->slug }}</code></p>
                
                @if($category->description)
                    <div class="mb-4">
                        <h5>Description</h5>
                        <p>{{ $category->description }}</p>
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <h4 class="text-primary">{{ $category->books_count }}</h4>
                            <p class="text-muted">Total Books</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <h4 class="text-success">{{ $category->books()->where('is_available', true)->count() }}</h4>
                            <p class="text-muted">Available Books</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <h4 class="text-warning">{{ $category->books()->where('stock_quantity', '<', 5)->count() }}</h4>
                            <p class="text-muted">Low Stock Books</p>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Created:</strong> {{ $category->created_at->format('F j, Y \a\t g:i A') }}<br>
                    <strong>Last Updated:</strong> {{ $category->updated_at->format('F j, Y \a\t g:i A') }}
                </div>
            </div>
        </div>

        <!-- Books in this category -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-books me-2"></i>Books in this Category</h5>
            </div>
            <div class="card-body">
                @if($category->books->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->books as $book)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.books.show', $book) }}" class="text-decoration-none">
                                            {{ $book->title }}
                                        </a>
                                    </td>
                                    <td>{{ $book->author }}</td>
                                    <td>${{ number_format($book->price, 2) }}</td>
                                    <td>
                                        @if($book->stock_quantity > 10)
                                            <span class="badge bg-success">{{ $book->stock_quantity }}</span>
                                        @elseif($book->stock_quantity > 0)
                                            <span class="badge bg-warning">{{ $book->stock_quantity }}</span>
                                        @else
                                            <span class="badge bg-danger">0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($book->is_available)
                                            <span class="badge bg-success">Available</span>
                                        @else
                                            <span class="badge bg-secondary">Unavailable</span>
                                        @endif
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
                    <p class="text-muted text-center">No books found in this category.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Category
                    </a>
                    
                    <a href="{{ route('admin.books.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Add Book to Category
                    </a>

                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" 
                                {{ $category->books_count > 0 ? 'disabled' : '' }}>
                            <i class="fas fa-trash me-2"></i>Delete Category
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 