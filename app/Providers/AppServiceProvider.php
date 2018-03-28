<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Billing\Stripe;

class AppServiceProvider extends ServiceProvider
{

    // Setting defer to true meaning that the resolution will not happen immediately after page load, but resolved when it's requested
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Listen to when a page load, then register a callback function
        view()->composer('posts.show', function ($view) {
            $view->with('archives', \App\Post::archives());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /* Method 1
        // \App::singleton('App\Billing\Stripe', function () {
        $this->app->singleton('App\Billing\Stripe', function () {
            return new \App\Billing\Stripe(config('services.stripe.secret'));
        });
        */

        // Method 2
        \App::singleton(Stripe::class, function () {
            return new Stripe(config('services.stripe.secret'));
        });
    }
}
