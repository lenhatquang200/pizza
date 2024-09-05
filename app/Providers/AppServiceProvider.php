<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Image;
use App\Models\Coupon;
use App\Models\Blog;
use App\Models\Menu;
use App\Models\Setting;
use App\Observers\SettingObserver;
use App\Observers\MenuObserver;
use App\Observers\BlogObserver;
use App\Observers\CouponObserver;
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
        Blog::observe(BlogObserver::class);
        Image::observe(ImageObserver::class);
        Coupon::observe(CouponObserver::class);
        Menu::observe(MenuObserver::class);
        Setting::observe(SettingObserver::class);
        Paginator::useBootstrapFour();

        view()->composer('*', function ($view) {
            $settings = Setting::all()->keyBy('title');
            $view->with('settings', $settings);
        });
    }
}
