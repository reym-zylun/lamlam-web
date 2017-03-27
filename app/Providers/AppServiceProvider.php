<?php

namespace App\Providers;

use Blade;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::directive('datetime', function($expression) {
            return "<?php echo date('Y.m.d H:i', strtotime({$expression})); ?>";
        });
        Blade::directive('millisecond', function($expression) {
            return "<?php echo strtotime({$expression}).'000'; ?>";
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
