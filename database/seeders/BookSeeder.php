<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'description' => 'A story of the fabulously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan.',
                'isbn' => '978-0743273565',
                'price' => 12.99,
                'stock_quantity' => 25,
                'published_date' => '1925-04-10',
                'category_id' => 1, // Fiction
                'is_available' => true
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'description' => 'The story of young Scout Finch and her father Atticus in a racially divided Alabama town.',
                'isbn' => '978-0446310789',
                'price' => 14.99,
                'stock_quantity' => 30,
                'published_date' => '1960-07-11',
                'category_id' => 1, // Fiction
                'is_available' => true
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'description' => 'A dystopian novel about totalitarianism and surveillance society.',
                'isbn' => '978-0451524935',
                'price' => 11.99,
                'stock_quantity' => 20,
                'published_date' => '1949-06-08',
                'category_id' => 3, // Science Fiction
                'is_available' => true
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'description' => 'The adventure of Bilbo Baggins, a hobbit who embarks on a quest with a group of dwarves.',
                'isbn' => '978-0547928241',
                'price' => 16.99,
                'stock_quantity' => 35,
                'published_date' => '1937-09-21',
                'category_id' => 1, // Fiction
                'is_available' => true
            ],
            [
                'title' => 'Steve Jobs',
                'author' => 'Walter Isaacson',
                'description' => 'The biography of Apple co-founder Steve Jobs, based on interviews with Jobs himself.',
                'isbn' => '978-1451648539',
                'price' => 19.99,
                'stock_quantity' => 15,
                'published_date' => '2011-10-24',
                'category_id' => 6, // Biography & Memoir
                'is_available' => true
            ],
            [
                'title' => 'The Da Vinci Code',
                'author' => 'Dan Brown',
                'description' => 'A mystery thriller about a murder in the Louvre Museum and a religious mystery.',
                'isbn' => '978-0307474278',
                'price' => 13.99,
                'stock_quantity' => 40,
                'published_date' => '2003-03-18',
                'category_id' => 4, // Mystery & Thriller
                'is_available' => true
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'description' => 'The story of Elizabeth Bennet and Mr. Darcy in early 19th century England.',
                'isbn' => '978-0141439518',
                'price' => 9.99,
                'stock_quantity' => 28,
                'published_date' => '1813-01-28',
                'category_id' => 5, // Romance
                'is_available' => true
            ],
            [
                'title' => 'The 7 Habits of Highly Effective People',
                'author' => 'Stephen R. Covey',
                'description' => 'A self-help book presenting an approach to being effective in attaining goals.',
                'isbn' => '978-0743269513',
                'price' => 18.99,
                'stock_quantity' => 22,
                'published_date' => '1989-08-15',
                'category_id' => 7, // Self-Help
                'is_available' => true
            ],
            [
                'title' => 'The Lean Startup',
                'author' => 'Eric Ries',
                'description' => 'A book about how to build a startup using validated learning and rapid experimentation.',
                'isbn' => '978-0307887894',
                'price' => 21.99,
                'stock_quantity' => 18,
                'published_date' => '2011-09-13',
                'category_id' => 8, // Business & Economics
                'is_available' => true
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'description' => 'A book exploring the ways in which biology and history have defined us.',
                'isbn' => '978-0062316097',
                'price' => 24.99,
                'stock_quantity' => 12,
                'published_date' => '2014-02-10',
                'category_id' => 2, // Non-Fiction
                'is_available' => true
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
