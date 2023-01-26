<?php

namespace Letsgoi\LaravelSettings\Repository;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingRepository
{
    public function find(string $key): string|float|array|bool|null
    {
        return Cache::rememberForever($key, static function () use ($key) {
            $setting = Setting::firstWhere('key', $key);

            if ($setting === null) {
                return null;
            }

            if ($setting->type === 'array') {
                return json_decode($setting->value, true);
            }

            return ($setting->type)($setting->value);
        });
    }
}
