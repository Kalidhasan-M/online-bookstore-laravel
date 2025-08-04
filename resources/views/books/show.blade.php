@extends('layouts.app')

@section('title', $book->title . ' - Online Book Store')

@section('content')
<div class="row">
    <!-- Book Details -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Book Cover -->
                    <div class="col-md-4">
                        @if($book->cover_image)
                            <img src="{{ asset($book->cover_image) }}" class="img-fluid rounded" alt="{{ $book->title }}">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 400px;">
                                <i class="fas fa-book fa-5x text-muted"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Book Information -->
                    <div class="col-md-8">
                        <h1 class="mb-3">{{ $book->title }}</h1>
                        <p class="lead text-muted">by {{ $book->author }}</p>
                        
                        <div class="mb-4">
                            <span class="badge bg-primary fs-6">{{ $book->category->name }}</span>
                            @if($book->isbn)
                                <span class="badge bg-secondary ms-2">ISBN: {{ $book->isbn }}</span>
                            @endif
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                                <h3 class="text-success">${{ number_format($book->price, 2) }}</h3>
                            </div>
                            <div class="col-6 text-end">
                                @if($book->stock_quantity > 0)
                                    <span class="badge bg-success fs-6">In Stock ({{ $book->stock_quantity }})</span>
                                @else
                                    <span class="badge bg-warning fs-6">Out of Stock</span>
                                @endif
                            </div>
                        </div>

                        @if($book->published_date)
                            <p class="text-muted">
                                <i class="fas fa-calendar me-2"></i>
                                Published: {{ $book->published_date->format('F j, Y') }}
                            </p>
                        @endif

                        <div class="mb-4">
                            <h5>Description</h5>
                            <p>{{ $book->description }}</p>
                        </div>

                        <div class="d-grid gap-2 d-md-flex">
                            @if($book->stock_quantity > 0)
                                <button class="btn btn-primary btn-lg">
                                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                </button>
                            @else
                                <button class="btn btn-secondary btn-lg" disabled>
                                    <i class="fas fa-times me-2"></i>Out of Stock
                                </button>
                            @endif
                            <button class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-heart me-2"></i>Add to Wishlist
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Books -->
        @if($relatedBooks->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-bookmark me-2"></i>Related Books
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($relatedBooks as $relatedBook)
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card book-card h-100">
                            @if($relatedBook->cover_image)
                                <img src="{{ asset($relatedBook->cover_image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $relatedBook->title }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-book fa-2x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h6 class="card-title">{{ $relatedBook->title }}</h6>
                                <p class="card-text text-muted small">by {{ $relatedBook->author }}</p>
                                <p class="card-text">
                                    <span class="badge bg-success">${{ number_format($relatedBook->price, 2) }}</span>
                                </p>
                                <a href="{{ route('books.show', $relatedBook) }}" class="btn btn-outline-primary btn-sm">View</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Book Stats -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Book Information</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <strong>Category:</strong> {{ $book->category->name }}
                    </li>
                    @if($book->isbn)
                    <li class="mb-2">
                        <strong>ISBN:</strong> {{ $book->isbn }}
                    </li>
                    @endif
                    @if($book->published_date)
                    <li class="mb-2">
                        <strong>Published:</strong> {{ $book->published_date->format('M Y') }}
                    </li>
                    @endif
                    <li class="mb-2">
                        <strong>Availability:</strong> 
                        @if($book->is_available)
                            <span class="text-success">Available</span>
                        @else
                            <span class="text-danger">Not Available</span>
                        @endif
                    </li>
                    <li class="mb-2">
                        <strong>Stock:</strong> {{ $book->stock_quantity }} copies
                    </li>
                </ul>
            </div>
        </div>

        <!-- Category Info -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-tag me-2"></i>{{ $book->category->name }}</h5>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $book->category->description }}</p>
                <a href="{{ route('books.index', ['category' => $book->category->id]) }}" class="btn btn-outline-primary btn-sm">
                    Browse More {{ $book->category->name }} Books
                </a>
            </div>
        </div>

        <!-- Share -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-share me-2"></i>Share</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary">
                        <i class="fab fa-facebook me-2"></i>Share on Facebook
                    </button>
                    <button class="btn btn-outline-info">
                        <i class="fab fa-twitter me-2"></i>Share on Twitter
                    </button>
                    <button class="btn btn-outline-success">
                        <i class="fab fa-whatsapp me-2"></i>Share on WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 