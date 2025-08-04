@extends('layouts.app')

@section('title', 'Home - Online Book Store')

@section('content')
<!-- Hero Section -->
<div class="bg-primary text-white py-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold">Welcome to Online Book Store</h1>
                <p class="lead">Discover thousands of books across all genres. From classic literature to modern bestsellers, we have something for every reader.</p>
                <a href="{{ route('books.index') }}" class="btn btn-light btn-lg">Browse Books</a>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-book-open" style="font-size: 8rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
        <!-- Featured Books -->
        <section class="mb-5">
            <h2 class="mb-4">
                <i class="fas fa-star text-warning me-2"></i>Featured Books
            </h2>
            <div class="row">
                @foreach($featuredBooks as $book)
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
                            <p class="card-text">
                                <span class="badge bg-primary">{{ $book->category->name }}</span>
                                <span class="badge bg-success ms-1">${{ number_format($book->price, 2) }}</span>
                            </p>
                            <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Categories -->
        <section class="mb-5">
            <h2 class="mb-4">
                <i class="fas fa-tags text-info me-2"></i>Browse by Category
            </h2>
            <div class="row">
                @foreach($categories as $category)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="card-text text-muted">{{ $category->books_count }} books</p>
                            <a href="{{ route('books.index', ['category' => $category->id]) }}" class="btn btn-outline-secondary btn-sm">Browse</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Weather Widget -->
        <div class="card weather-card mb-4">
            <div class="card-body text-center">
                <h5 class="card-title">
                    <i class="fas fa-cloud-sun me-2"></i>Weather
                </h5>
                <h3>{{ $weather['name'] ?? 'London' }}</h3>
                <div class="display-4">{{ round($weather['main']['temp'] ?? 20) }}°C</div>
                <p class="mb-0">{{ $weather['weather'][0]['description'] ?? 'Partly cloudy' }}</p>
                <small>Humidity: {{ $weather['main']['humidity'] ?? 65 }}%</small>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Store Stats</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h4 class="text-primary">{{ $featuredBooks->count() }}</h4>
                        <small class="text-muted">Featured Books</small>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success">{{ $categories->count() }}</h4>
                        <small class="text-muted">Categories</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter Signup -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Stay Updated</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Get notified about new releases and special offers.</p>
                <form>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Enter your email">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 