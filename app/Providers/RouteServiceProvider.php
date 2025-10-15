<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot(): void
    {
        foreach (glob(base_path('routes/*.php')) as $routeFile) {
            if (!in_array(basename($routeFile), ['api.php', 'console.php', 'channels.php'])) 
                {
                Route::middleware('web')->group($routeFile);
            }               
        }
    }
 }
