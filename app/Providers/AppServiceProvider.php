<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Categorie;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Route::model("categorie" , Categorie::class) ;
        Paginator::useBootstrapFive() ;
    }
}
