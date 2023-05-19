<?php

namespace App\Providers;

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
    //起動のたびに実行される箇所
    public function boot(): void
    {
        //ownerから始まるURLのとき
        if(request()->is('owner*')) {
            config(['session.cookie' => config('session.cookie_owner')]);
        }
        //adminから始まるURLのとき
        if(request()->is('admin*')) {
            config(['session.cookie' => config('session.cookie_admin')]);
        }
    }
}
