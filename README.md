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

## 🚀 Quick Start

### Option 1: Using Git Clone
```bash
# Clone the repository
git clone https://github.com/Kalidhasan-M/online-bookstore-laravel.git
cd online-bookstore-laravel

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env file
# Then run migrations and seeders
php artisan migrate
php artisan db:seed

# Create storage link
php artisan storage:link

# Start the server
php artisan serve
```

### Option 2: Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Kalidhasan-M/online-bookstore-laravel.git
   cd online-bookstore-laravel
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

9. **Access the application**
   - **Public Site**: http://localhost:8000
   - **Admin Panel**: http://localhost:8000/admin/login

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

## 🛠️ Development Workflow

### Making Changes
```bash
# Create a new branch for your feature
git checkout -b feature/your-feature-name

# Make your changes
# Test your changes

# Commit your changes
git add .
git commit -m "Add your feature description"

# Push to GitHub
git push origin feature/your-feature-name
```

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=BookTest
```

### Database Operations
```bash
# Create a new migration
php artisan make:migration create_new_table

# Rollback last migration
php artisan migrate:rollback

# Reset database and re-seed
php artisan migrate:fresh --seed
```

## 🔍 Troubleshooting

### Common Issues

#### 1. Database Connection Error
```bash
# Check your .env file configuration
# Ensure MySQL is running
# Verify database credentials
```

#### 2. Permission Denied Error
```bash
# Set proper permissions for storage and bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

#### 3. Composer Dependencies Error
```bash
# Clear composer cache
composer clear-cache
composer install --no-cache
```

#### 4. Laravel Application Key Error
```bash
# Generate application key
php artisan key:generate
```

#### 5. Storage Link Error
```bash
# Remove existing link and recreate
rm public/storage
php artisan storage:link
```

### Environment Setup Issues

#### Windows Users
- Install XAMPP or WAMP for MySQL
- Use Git Bash for terminal commands
- Ensure PHP is in your system PATH

#### macOS Users
- Install MAMP or use Homebrew
- Use Terminal or iTerm2
- Install MySQL via Homebrew: `brew install mysql`

#### Linux Users
- Install LAMP stack
- Use terminal
- Install MySQL: `sudo apt-get install mysql-server`

## 🚀 Deployment

### Local Development
```bash
# Start development server
php artisan serve

# Or use Laravel Sail (Docker)
./vendor/bin/sail up
```

### Production Deployment

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

### Docker Deployment
```bash
# Build Docker image
docker build -t online-bookstore .

# Run container
docker run -p 8000:8000 online-bookstore
```

## 📊 Performance Optimization

### Caching
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache
```

### Database Optimization
```bash
# Optimize database queries
php artisan optimize

# Clear all caches
php artisan cache:clear
```

## 🔒 Security Considerations

- Change default admin credentials
- Use HTTPS in production
- Set proper file permissions
- Keep dependencies updated
- Use environment variables for sensitive data

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Code Style
- Follow PSR-12 coding standards
- Use meaningful commit messages
- Add comments for complex logic
- Write tests for new features

## 📞 Support

For support and questions:
- Create an issue on GitHub
- Contact the development team
- Check the troubleshooting section above

## 🙏 Acknowledgments

- Laravel team for the amazing framework
- Bootstrap team for the UI components
- OpenWeatherMap for the weather API
- All contributors to this project

---

**Note**: This is a complete Laravel application built from scratch for educational and demonstration purposes. All code is original and follows Laravel best practices.

**⭐ Star this repository if you find it helpful!**
