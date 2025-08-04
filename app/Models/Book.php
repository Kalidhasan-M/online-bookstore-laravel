<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'isbn',
        'price',
        'stock_quantity',
        'cover_image',
        'published_date',
        'category_id',
        'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'published_date' => 'date',
        'is_available' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
