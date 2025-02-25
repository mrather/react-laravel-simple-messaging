<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class SwaggerUiServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        /**
         * Register the Swagger UI gate.
         *
         * This gate determines who can access Swagger UI in non-local environments.
         *
         * @return void
         */        
        Gate::define('viewSwaggerUI', function ($user = null) {
            /*
            return in_array(optional($user)->email, [
                //
            ]);
            */
        });
    }
}