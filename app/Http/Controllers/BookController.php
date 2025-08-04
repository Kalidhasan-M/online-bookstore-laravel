<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'isbn' => 'nullable|string|max:20',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'published_date' => 'nullable|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/books'), $imageName);
            $data['cover_image'] = 'images/books/' . $imageName;
        }

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'isbn' => 'nullable|string|max:20',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'published_date' => 'nullable|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image && file_exists(public_path($book->cover_image))) {
                unlink(public_path($book->cover_image));
            }
            
            $image = $request->file('cover_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/books'), $imageName);
            $data['cover_image'] = 'images/books/' . $imageName;
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        // Delete cover image if exists
        if ($book->cover_image && file_exists(public_path($book->cover_image))) {
            unlink(public_path($book->cover_image));
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Book deleted successfully.');
    }

    public function toggleAvailability(Book $book)
    {
        $book->update(['is_available' => !$book->is_available]);
        
        return redirect()->route('admin.books.index')
            ->with('success', 'Book availability updated successfully.');
    }
}
