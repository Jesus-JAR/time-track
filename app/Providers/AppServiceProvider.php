<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Business;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
                //
                $business = Business::all()->where('id', '!=', 1);
                return view()->share('business', $business);
    }
}
