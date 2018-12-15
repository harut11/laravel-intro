<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Item;
use App\Observers\UserObserver;
use App\Observers\ItemObserver;
use Illuminate\Support\ServiceProvider;
use Schema;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
        Item::observe(ItemObserver::class);
        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            preg_match('/^(\+[0-9]{1,3}|0)[0-9]{3}( ){0,1}[0-9]{7,8}\b/', $value, $matches);
            if (count($matches)) {
                return true;
            }
            return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
