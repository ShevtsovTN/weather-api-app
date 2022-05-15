<?php

namespace Modules\Weather\Providers;

use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected string $moduleName = 'Weather';

    public array $bindings = [];

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(base_path('modules\\' . $this->moduleName . '\database\migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->register(WeatherRouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [];
    }
}
