@extends('layouts.app')

@section('title', 'Books - Online Book Store')

@section('content')
<div class="row">
    <!-- Filters Sidebar -->
    <div class="col-lg-3">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filters</h5>
            </div>
            <div class="card-body">
                <!-- Search -->
                <form action="{{ route('books.index') }}" method="GET">
                    <div class="mb-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Search books...">
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>Apply Filters
                    </button>
                </form>

                <!-- Clear Filters -->
                @if(request('search') || request('category'))
                    <div class="mt-3">
                        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-times me-2"></i>Clear Filters
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Categories List -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-tags me-2"></i>Categories</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach($categories as $category)
                        <a href="{{ route('books.index', ['category' => $category->id]) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            {{ $category->name }}
                            <span class="badge bg-primary rounded-pill">{{ $category->books_count ?? 0 }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Books Grid -->
    <div class="col-lg-9">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-books me-2"></i>Books
                @if(request('search') || request('category'))
                    <small class="text-muted">
                        ({{ $books->total() }} results)
                    </small>
                @endif
            </h2>
        </div>

        <!-- Books Grid -->
        @if($books->count() > 0)
            <div class="row">
                @foreach($books as $book)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card book-card h-100">
                        @if($book->cover_image)
                            <img src="{{ asset($book->cover_image) }}" class="card-img-top book-cover" alt="{{ $book->title }}">
                        @else
                            <div class="card-img-top book-cover bg-light d-flex align-items-center justify-content-center">
                                <i class="fas fa-book fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted">by {{ $book->author }}</p>
                            <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                            <div class="mb-3">
                                <span class="badge bg-primary">{{ $book->category->name }}</span>
                                <span class="badge bg-success ms-1">${{ number_format($book->price, 2) }}</span>
                                @if($book->stock_quantity > 0)
                                    <span class="badge bg-info ms-1">In Stock ({{ $book->stock_quantity }})</span>
                                @else
                                    <span class="badge bg-warning ms-1">Out of Stock</span>
                                @endif
                            </div>
                            <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $books->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h4>No books found</h4>
                <p class="text-muted">Try adjusting your search criteria or browse all books.</p>
                <a href="{{ route('books.index') }}" class="btn btn-primary">Browse All Books</a>
            </div>
        @endif
    </div>
</div>
@endsection 