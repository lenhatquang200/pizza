<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Image;
use App\Observers\ImageObserver;

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
        //
        Image::observe(ImageObserver::class);
    }
}
