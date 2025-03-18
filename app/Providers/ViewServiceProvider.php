<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Slider;

class ViewServiceProvider extends ServiceProvider
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
        // Compartir la variable $sliders con la vista partials.slider
        View::composer('partials.slider', function ($view) {
            $sliders = Slider::where('status', 1)->get(); // Obtener banners activos
            $view->with('sliders', $sliders);
        });
    }
}