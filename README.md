# Larabanner

A simple, flexible banner management system for Laravel 11+.

## Features

- Schedule banners with start and end dates
- Set display days (e.g., weekdays only)
- Soft deletes supported
- Full CRUD interface
- Simple Blade directive for displaying banners

## Installation

You can install the package via composer:

```bash
composer require yourusername/larabanner
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Yourusername\Larabanner\LarabannerServiceProvider" --tag="config"
```

Run the migrations:

```bash
php artisan migrate
```

## Usage

In your Blade templates:

```php
@banner(1)  // Displays banner with ID 1 if it's currently active
```

### Managing Banners

Access the banner management interface at `/banners` (configurable in config/larabanner.php).

## Configuration Options

```php
// config/larabanner.php
return [
'pagination' => 15, // Number of items per page in the admin panel
'route_prefix' => 'banners', // URL prefix for the admin panel
'middleware' => ['web', 'auth'], // Middleware for the admin panel
];
```

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

