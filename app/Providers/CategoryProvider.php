<?php

namespace App\Providers;

use App\CategoriaReceta;
use View;
use Illuminate\Support\ServiceProvider;

class CategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services. 
     *
     * @return void
     */
    public function boot()
    {
        // Para mostrar las categorias en todas las vistas al momento de que la aplicación esté lista
        View::composer('*', function ($view) {
            $categories = CategoriaReceta::all();
            $view->with('categorias', $categories);
        });
    }
}
