<?php

namespace Letsgoi\LaravelSettings\Nova\Resources;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;
use Letsgoi\LaravelSettings\Models\Setting;

class SettingNovaResource extends Resource
{
    public static $model = Setting::class;

    public static $title = 'key';

    public static $search = [
        'key',
    ];

    public static function authorizedToCreate(Request $request): bool
    {
        return false;
    }

    public static function authorizedToDelete(Request $request): bool
    {
        return false;
    }

    public static function label(): string
    {
        return 'Settings';
    }

    public function fields(Request $request)
    {
        return [
            Text::make('Key', 'key')->sortable()->readOnly(),
            Text::make('Value', 'value')->sortable()->required(),
            Text::make('Type', 'type')->sortable()->readOnly(),
        ];
    }
}
