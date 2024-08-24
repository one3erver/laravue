<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;

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
        Schema::defaultStringLength(191);
        $setting = Setting::first();
        if ($setting) {
            $sharedSettings = $setting->only(['site_title', 'landing_content', 'logo']);
            view()->composer('admin.layouts.header', function ($view) use ($sharedSettings) {
                $view->with('site_title', $sharedSettings['site_title']);
                $view->with('logo', $sharedSettings['logo']);
            });


            Inertia::share('setting', $sharedSettings);
        }
    }
}
