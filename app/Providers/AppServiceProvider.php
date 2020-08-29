<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $aux = \App\Rig::first();
        $publicKey = $aux->captcha["public"];


        view()->composer('*', function($view) use ($publicKey) {
            $view->with('publicKey', $publicKey);
        });
    }
}
