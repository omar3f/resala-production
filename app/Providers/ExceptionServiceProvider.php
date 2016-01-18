<?php

namespace App\Providers;

use App\Exceptions\RedirectException;
use Illuminate\Support\ServiceProvider;

class ExceptionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('\Exception', function() {
            return new \Exception();
        });
        $this->app->bind('\App\Exceptions\RedirectException', function() {
            return new RedirectException();
        });
    }
}