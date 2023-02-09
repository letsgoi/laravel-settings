<?php

namespace Letsgoi\LaravelSettings\Repository;

use Exception;
use Illuminate\Support\Facades\Cache;
use Letsgoi\LaravelSettings\Models\Setting;

class SettingRepository
{
    private const CACHE_PREFIX = 'letsgoi-laravel-settings-';

    public function find(string $id): string|float|array|bool
    {
        return Cache::rememberForever($this->cacheId($id), static function () use ($id) {
            $setting = Setting::find($id);

            if ($setting === null) {
                throw new Exception('The setting with id ' . $id . ' does not exist');
            }

            return $setting->value;
        });
    }

    public function forgetCache(Setting $setting): void
    {
        Cache::forget($this->cacheId($setting->id));
    }

    private function cacheId(string $id): string
    {
        return self::CACHE_PREFIX . $id;
    }
}
