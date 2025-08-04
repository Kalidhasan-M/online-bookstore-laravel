# Online Book Store - Laravel Application

A complete online book store application built with Laravel 10, featuring a modern responsive UI, admin dashboard, and API integration.

## 🚀 Features

### Public Features
- **Home Page**: Featured books, categories, and weather widget
- **Book Listing**: Search and filter books by category
- **Book Details**: Comprehensive book information with related books
- **Responsive Design**: Modern UI using Bootstrap 5

### Admin Features
- **Admin Dashboard**: Statistics and quick actions
- **Book Management**: CRUD operations for books
- **Category Management**: CRUD operations for categories
- **Stock Management**: Track book availability and stock levels
- **Image Upload**: Book cover image management

### API Integration
- **Weather API**: OpenWeatherMap integration for location-based weather
- **Extensible**: Easy to add more API integrations

## 🛠️ Technology Stack

- **Backend**: Laravel 10
- **Frontend**: Bootstrap 5, Font Awesome
- **Database**: MySQL
- **API**: OpenWeatherMap (Weather data)

## 📋 Requirements

- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher
- Node.js (for asset compilation)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd example-task
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file and set your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_task
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Create storage link**
   ```bash
   php artisan storage:link
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🔐 Default Admin Credentials

- **Email**: admin@bookstore.com
- **Password**: password123

## 📁 Project Structure

```
example-task/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php
│   │   ├── BookController.php
│   │   ├── CategoryController.php
│   │   └── HomeController.php
│   └── Models/
│       ├── Book.php
│       └── Category.php
├── database/
│   ├── migrations/
│   │   ├── create_categories_table.php
│   │   └── create_books_table.php
│   └── seeders/
│       ├── BookSeeder.php
│       └── CategorySeeder.php
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── books/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── login.blade.php
│   │   ├── books/
│   │   └── categories/
│   └── home.blade.php
└── routes/
    └── web.php
```

## 🎯 Key Features Implementation

### 1. Database Design
- **Books Table**: title, author, description, price, stock, category, etc.
- **Categories Table**: name, slug, description
- **Users Table**: Laravel's default user authentication

### 2. MVC Architecture
- **Models**: Book, Category with relationships
- **Controllers**: Separate controllers for public and admin functionality
- **Views**: Blade templates with Bootstrap styling

### 3. Admin Dashboard
- Statistics cards (total books, categories, users)
- Recent books and low stock alerts
- Quick action buttons

### 4. Book Management
- Full CRUD operations
- Image upload for book covers
- Stock management
- Availability toggle

### 5. Search and Filter
- Search by title, author, description
- Filter by category
- Pagination

### 6. API Integration
- Weather API integration (OpenWeatherMap)
- Fallback data when API is unavailable
- Extensible for additional APIs

## 🌐 Routes

### Public Routes
- `GET /` - Home page
- `GET /books` - Book listing with search/filter
- `GET /books/{book}` - Book details

### Admin Routes
- `GET /admin/login` - Admin login
- `POST /admin/login` - Admin authentication
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/books` - Manage books
- `GET /admin/categories` - Manage categories

## 🎨 UI/UX Features

- **Responsive Design**: Works on all device sizes
- **Modern UI**: Clean, professional design with Bootstrap 5
- **Interactive Elements**: Hover effects, transitions
- **User-Friendly**: Intuitive navigation and clear call-to-actions
- **Accessibility**: Proper semantic HTML and ARIA labels

## 🔧 Customization

### Adding New Categories
1. Go to Admin Dashboard
2. Click "Add Category"
3. Fill in name and description
4. Save

### Adding New Books
1. Go to Admin Dashboard
2. Click "Add New Book"
3. Fill in all required fields
4. Upload cover image (optional)
5. Save

### Weather API Configuration
To use real weather data, update the API key in `HomeController.php`:
```php
'appid' => 'your_actual_api_key_here'
```

## 🚀 Deployment

1. **Production environment setup**
   ```bash
   composer install --optimize-autoloader --no-dev
   npm run build
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Set up web server** (Apache/Nginx)
3. **Configure environment variables**
4. **Set up database**
5. **Run migrations**

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## 📞 Support

For support and questions, please contact the development team.

---

**Note**: This is a complete Laravel application built from scratch for educational and demonstration purposes. All code is original and follows Laravel best practices.
