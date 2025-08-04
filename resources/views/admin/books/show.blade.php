@extends('layouts.app')

@section('title', 'View Book - Admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-eye me-2"></i>View Book</h1>
            <div>
                <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-primary me-2">
                    <i class="fas fa-edit me-2"></i>Edit Book
                </a>
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Books
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-book me-2"></i>Book Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($book->cover_image)
                            <img src="{{ asset($book->cover_image) }}" class="img-fluid rounded" alt="{{ $book->title }}">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 400px;">
                                <i class="fas fa-book fa-5x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h2>{{ $book->title }}</h2>
                        <p class="lead text-muted">by {{ $book->author }}</p>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Category:</strong> 
                                <span class="badge bg-primary">{{ $book->category->name }}</span>
                            </div>
                            <div class="col-md-6">
                                <strong>Price:</strong> 
                                <span class="text-success fw-bold">${{ number_format($book->price, 2) }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Stock Quantity:</strong> 
                                @if($book->stock_quantity > 10)
                                    <span class="badge bg-success">{{ $book->stock_quantity }}</span>
                                @elseif($book->stock_quantity > 0)
                                    <span class="badge bg-warning">{{ $book->stock_quantity }}</span>
                                @else
                                    <span class="badge bg-danger">0</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <strong>Status:</strong> 
                                @if($book->is_available)
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-secondary">Unavailable</span>
                                @endif
                            </div>
                        </div>

                        @if($book->isbn)
                            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                        @endif

                        @if($book->published_date)
                            <p><strong>Published Date:</strong> {{ $book->published_date->format('F j, Y') }}</p>
                        @endif

                        <div class="mb-3">
                            <strong>Description:</strong>
                            <p class="mt-2">{{ $book->description }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Created:</strong> {{ $book->created_at->format('F j, Y \a\t g:i A') }}<br>
                            <strong>Last Updated:</strong> {{ $book->updated_at->format('F j, Y \a\t g:i A') }}
                        </div>
                    </div>
                </div>
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
                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Book
                    </a>
                    
                    <form action="{{ route('admin.books.toggle-availability', $book) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="fas fa-toggle-on me-2"></i>
                            {{ $book->is_available ? 'Make Unavailable' : 'Make Available' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this book?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Delete Book
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-tag me-2"></i>Category Info</h5>
            </div>
            <div class="card-body">
                <h6>{{ $book->category->name }}</h6>
                <p class="text-muted">{{ $book->category->description }}</p>
                <a href="{{ route('admin.categories.show', $book->category) }}" class="btn btn-outline-primary btn-sm">
                    View Category
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 