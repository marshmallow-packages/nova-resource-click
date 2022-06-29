<?php

namespace Marshmallow\NovaResourceClick;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class ToolServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/nova-resource-click.php' => config_path('nova-resource-click.php'),
        ], 'config');

        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-resource-click', __DIR__ . '/../dist/js/nova-resource-click.js');
            Nova::provideToScript([
                'ResourceClickDefault' => config('nova-resource-click.default', 'view'),
            ]);
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/nova-resource-click.php',
            'nova-resource-click'
        );
    }
}
