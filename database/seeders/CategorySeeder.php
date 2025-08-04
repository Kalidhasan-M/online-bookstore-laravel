<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fiction',
                'description' => 'Imaginative literature including novels, short stories, and poetry.'
            ],
            [
                'name' => 'Non-Fiction',
                'description' => 'Factual literature including biographies, history, and science books.'
            ],
            [
                'name' => 'Science Fiction',
                'description' => 'Fiction dealing with futuristic science and technology.'
            ],
            [
                'name' => 'Mystery & Thriller',
                'description' => 'Suspenseful stories with crime, detective work, and psychological elements.'
            ],
            [
                'name' => 'Romance',
                'description' => 'Love stories and romantic fiction.'
            ],
            [
                'name' => 'Biography & Memoir',
                'description' => 'True stories about people\'s lives and experiences.'
            ],
            [
                'name' => 'Self-Help',
                'description' => 'Books designed to help readers improve themselves.'
            ],
            [
                'name' => 'Business & Economics',
                'description' => 'Books about business, finance, and economic principles.'
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description']
            ]);
        }
    }
}
