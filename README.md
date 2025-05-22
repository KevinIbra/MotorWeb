# Motorcycle Marketplace Website

A web application for buying and selling motorcycles built with Laravel. This platform allows users to list their motorcycles for sale, browse listings, and manage their favorites.

## Features

- **User Authentication**
  - Login and registration system
  - Role-based access (Admin, Buyer)
  - User profile management

- **Motorcycle Listings**
  - Create, edit, and delete motorcycle listings
  - Upload multiple images
  - Search and filter motorcycles
  - Advanced filtering by make, model, year, and price range

- **Favorites System**
  - Add/remove motorcycles to favorites
  - View favorited motorcycles
  - Quick access to saved listings

- **Admin Features**
  - Dashboard for managing listings
  - User management
  - Content moderation

## Technical Requirements

- PHP 8.4.3
- Laravel 12.3.0
- MySQL 5.7+
- Composer
- Node.js & NPM
- XAMPP

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/website-jual-beli-motor.git
cd website-jual-beli-motor
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Set up environment file:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=motorcycle_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Run migrations and seeders:
```bash
php artisan migrate
php artisan db:seed
```

6. Start the development server:
```bash
php artisan serve
```

## Usage

1. Register as a new user
2. Log in to your account
3. Browse motorcycles or create new listings
4. Add motorcycles to favorites
5. Contact sellers through the platform

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

Your Name - 237006073@student.unsil.ac.id
Project Link: https://github.com/KevinIbra/MotorWeb.git