@extends('layouts.app')

@section('title', 'Manage Books - Admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-books me-2"></i>Manage Books</h1>
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Book
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($books->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>
                                @if($book->cover_image)
                                    <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}" 
                                         style="width: 50px; height: 70px; object-fit: cover;" class="rounded">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 70px;">
                                        <i class="fas fa-book text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $book->title }}</strong>
                                @if($book->isbn)
                                    <br><small class="text-muted">ISBN: {{ $book->isbn }}</small>
                                @endif
                            </td>
                            <td>{{ $book->author }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $book->category->name }}</span>
                            </td>
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
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.books.show', $book) }}" 
                                       class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.books.edit', $book) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.books.toggle-availability', $book) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-warning" title="Toggle Availability">
                                            <i class="fas fa-toggle-on"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.books.destroy', $book) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this book?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
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
                {{ $books->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-books fa-3x text-muted mb-3"></i>
                <h4>No books found</h4>
                <p class="text-muted">Start by adding your first book to the store.</p>
                <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add First Book
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 