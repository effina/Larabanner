<?php

namespace effina\Larabanner;

use effina\Larabanner\Models\Larabanner;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class LarabannerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'larabanner');

        // Publish configuration
        $this->publishes([
            __DIR__.'/../config/larabanner.php' => config_path('larabanner.php'),
        ], 'config');

        // Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/larabanner'),
        ], 'views');

        // Register blade directive
        Blade::directive('banner', function ($expression) {
            $model = '\\' . Larabanner::class;

            return "<?php echo {$model}::renderDisplayable({$expression}); ?>";
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Merge configuration
        $this->mergeConfigFrom(
            __DIR__.'/../config/larabanner.php', 'larabanner'
        );
    }
}
