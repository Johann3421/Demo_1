<?php

namespace App\Providers;

use App\Models\Categoria;
use App\Models\Configuracion;
use App\Models\Grupo;
use App\Models\Subgrupo;
use Illuminate\Support\Facades\View;
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
    public function boot()
    {
        // Compartir variables con la vista subheader.blade.php
        View::composer('partials.subheader', function ($view) {
            $categorias = Categoria::with(['grupos.subgrupos'])->get();
            $grupos = Grupo::with('categoria')->get();
            $subgrupos = Subgrupo::with('grupo')->get();

            $view->with('categorias', $categorias)
                 ->with('grupos', $grupos)
                 ->with('subgrupos', $subgrupos);
        });
        View::composer('*', function ($view) {
            $config = Configuracion::first();
            $precio_dolar = $config ? number_format($config->precio_dolar, 2) : '0.00';
            $view->with('precio_dolar', $precio_dolar);
        });
    }
}
