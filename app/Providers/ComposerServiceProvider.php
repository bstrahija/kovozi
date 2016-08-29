<?php

namespace App\Providers;

use Auth, View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer('*', function() {
            View::share('current_user',  Auth::user());
            View::share('logged_in',     Auth::user() ? true : false);
        });
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {

    }
}
