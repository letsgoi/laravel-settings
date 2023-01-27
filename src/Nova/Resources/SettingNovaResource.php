<?php

namespace Letsgoi\LaravelSettings\Nova\Resources;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Number;
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

    public static function label(): string
    {
        return 'Settings';
    }


    public function authorizedToDelete(Request $request): bool
    {
        return false;
    }

    public function fields(Request $request)
    {
        $valueField = match ($this->resource->type) {
            'int' => Number::make('Value', 'value')->sortable()->required(),
            'float' => Number::make('Value', 'value')->sortable()->required()->step(0.01),
            'bool' => Boolean::make('Value', 'value')->sortable()->required()->withMeta(['textAlign' => 'left']),
            'array' => Code::make('Value', 'value')->json()->sortable()->required()->showOnIndex(),
            default => Text::make('Value', 'value')->sortable()->required(),
        };

        return [
            Text::make('Key', 'key')->sortable()->readOnly(),
            Text::make('Type', 'type')->sortable()->readOnly(),
            $valueField,
        ];
    }
}
