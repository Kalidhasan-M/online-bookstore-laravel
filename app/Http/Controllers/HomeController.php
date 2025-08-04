<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $featuredBooks = Book::where('is_available', true)
            ->with('category')
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount('books')->get();

        // Weather API integration (using OpenWeatherMap API)
        $weather = $this->getWeatherData();

        return view('home', compact('featuredBooks', 'categories', 'weather'));
    }

    public function books(Request $request)
    {
        $query = Book::where('is_available', true)->with('category');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $books = $query->paginate(12);
        $categories = Category::all();

        return view('books.index', compact('books', 'categories'));
    }

    public function show(Book $book)
    {
        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->where('is_available', true)
            ->take(4)
            ->get();

        return view('books.show', compact('book', 'relatedBooks'));
    }

    private function getWeatherData()
    {
        try {
            // Using OpenWeatherMap API (you'll need to get a free API key)
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => 'London,UK', // Default location
                'appid' => 'your_api_key_here', // Replace with actual API key
                'units' => 'metric'
            ]);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Exception $e) {
            // Return default weather data if API fails
        }

        return [
            'name' => 'London',
            'main' => ['temp' => 20, 'humidity' => 65],
            'weather' => [['description' => 'Partly cloudy']]
        ];
    }
}
