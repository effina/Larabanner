# Larabanner

A simple, flexible banner management system for Laravel 11, 12, and 13.

## Features

- Schedule banners with start and end dates
- Set display days (e.g., weekdays only)
- Soft deletes supported
- Full CRUD interface
- Simple Blade directive for displaying banners

## Installation

You can install the package via composer:

```bash
composer require effina/larabanner
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="effina\Larabanner\LarabannerServiceProvider" --tag="config"
```

Run the migrations:

```bash
php artisan migrate
```

## Usage

In your Blade templates:

```blade
{{-- Display banner #1, if it is currently active --}}
@banner(1)

{{-- The ID can come from a variable --}}
@banner($bannerId)

{{-- Display every currently active banner --}}
@banner
```

A banner is active when the current time is between its start and end dates and, if display days are set, today is one of them. Banner contents are output as raw HTML, so only trusted users should be able to manage banners.

> **Upgrading from an earlier version?** `@banner(id)` previously ignored the ID and displayed every active banner. Run `php artisan view:clear` after upgrading so your compiled views pick up the new behavior.

### Managing Banners

Access the banner management interface at `/banners` (configurable in config/larabanner.php).

## Configuration Options

```php
// config/larabanner.php
return [
    'pagination' => 15, // Number of items per page in the admin panel
    'route_prefix' => 'banners', // URL prefix for the admin panel
    'middleware' => ['web', 'auth'], // Middleware for the admin panel
    'layout' => null, // Your app layout (e.g. 'layouts.admin'); null uses the built-in layout
    'sections' => [ // Section names your layout yields
        'content' => 'content',
        'title' => 'title',
        'scripts' => 'scripts',
        'styles' => 'styles',
    ],
];
```

### Customizing Views

To customize the admin views, publish them to `resources/views/vendor/larabanner`:

```bash
php artisan vendor:publish --provider="effina\Larabanner\LarabannerServiceProvider" --tag="views"
```

If you published the views before upgrading, republish them (or update `layouts/app.blade.php` by hand) to pick up the fix for the built-in layout.

## Testing

```bash
vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

