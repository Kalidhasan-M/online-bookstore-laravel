<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBooks = Book::count();
        $availableBooks = Book::where('is_available', true)->count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        $recentBooks = Book::with('category')
            ->latest()
            ->take(5)
            ->get();

        $lowStockBooks = Book::where('stock_quantity', '<', 5)
            ->where('is_available', true)
            ->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'availableBooks',
            'totalCategories',
            'totalUsers',
            'recentBooks',
            'lowStockBooks'
        ));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
