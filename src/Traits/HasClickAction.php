<?php

namespace Marshmallow\NovaResourceClick\Traits;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

trait HasClickAction
{
    public static function clickAction()
    {
        if (isset(static::$clickAction)) return static::$clickAction;
        return config('nova-resource-click.default') ?? 'view';
    }

    public static function additionalInformation(Request $request)
    {
        return [
            'onClickAction' => static::clickAction()
        ];
    }
}
