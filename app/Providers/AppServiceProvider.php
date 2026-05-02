<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $compiledPath = sys_get_temp_dir().DIRECTORY_SEPARATOR.'credfast-runtime-views';

        if (! is_dir($compiledPath)) {
            File::ensureDirectoryExists($compiledPath);
        }

        $this->app['config']->set('view.compiled', $compiledPath);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
