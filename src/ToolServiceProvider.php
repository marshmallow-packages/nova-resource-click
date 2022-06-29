<?php

namespace Marshmallow\NovaResourceClick;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use OptimistDigital\NovaTranslationsLoader\LoadsNovaTranslations;

class ToolServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-resource-click', __DIR__ . '/../dist/js/tool.js');
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) return;

        Route::middleware(['nova'])
            ->prefix('nova-vendor/nova-resource-click')
            ->domain(config('nova.domain', null))
            ->namespace('\Marshmallow\NovaResourceClick\Http\Controllers')
            ->group(__DIR__ . '/../routes/api.php');
    }
}
