<?php

namespace App\Providers;

use App\Models\Api\Nurseries\Nursery;
use App\Observers\Api\Nurseries\NurseryObserver;
use App\Repositories\Classes\Api\Nurseries\Profile\BabySitterRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabySitterRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app['request']->server->set('HTTPS', true);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//       \URL::forceScheme('https');
        if($this->app->environment('production')) {
        }

        Schema::defaultStringLength(191);
        \Illuminate\Support\Facades\Validator::extend('phone_number', function($attribute, $value, $parameters)
        {
            return substr($value, 0, 1) == '+';
        });
        Model::preventLazyLoading(! $this->app->isProduction());
        Nursery::observe(NurseryObserver::class);

    }
}
