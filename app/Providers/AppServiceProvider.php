<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        \URL::forceScheme('https')
        //
        Blade::directive('admin',function (){
            return "<?php if(auth()->user()->is_admin): ?>";
        });
        Blade::directive('endadmin',function (){
            return "<?php endif; ?>";
        });

        Blade::directive('stakeholder',function (){
            return "<?php if(auth()->user()->is_stakeholder): ?>";
        });
        Blade::directive('endstakeholder',function (){
            return "<?php endif; ?>";
        });
    }
}
