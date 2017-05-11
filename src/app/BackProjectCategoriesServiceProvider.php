<?php

namespace Afrittella\BackProjectCategories;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class BackProjectCategoriesServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot(Router $router)
    {
        // LOAD THE VIEWS
        // - first the published views (in case they have any changes)
        $this->loadViewsFrom(resource_path('views/vendor/back-project-categories/base'), 'back-project-categories');
        // - then the stock views that come with the package, in case a published view might be missing
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'back-project-categories');

        // Load Translations
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'back-project-categories');

        // Load Migrations
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../database/migrations'));

        // Load Routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->registerCommands();

        $this->publishFiles();
    }

    public function register()
    {

    }

    private function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Afrittella\BackProjectCategories\Console\Commands\SeedMenu::class,
                \Afrittella\BackProjectCategories\Console\Commands\SeedDefaultCategories::class,
            ]);
        }
    }

    private function publishFiles()
    {
        // publish lang files
        $this->publishes([__DIR__ . '/../resources/lang' => resource_path('lang/vendor/back-project-categories')], 'lang');
        // publish views
        $this->publishes([__DIR__ . '/../resources/views' => resource_path('views/vendor/back-project-categories')], 'views');
    }
}