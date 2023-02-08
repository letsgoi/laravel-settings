<?php

namespace Letsgoi\LaravelSettings\Repository;

use Exception;
use Illuminate\Support\Facades\Cache;
use Letsgoi\LaravelSettings\Models\Setting;

class SettingRepository
{
    private const CACHE_PREFIX = 'letsgoi-laravel-settings-';

    public function find(string $key): string|float|array|bool
    {
        return Cache::rememberForever($this->cacheKey($key), static function () use ($key) {
            $setting = Setting::firstWhere('key', $key);

            if ($setting === null) {
                throw new Exception('The setting with key ' . $key . ' does not exist');
            }

            return $setting->value;
        });
    }

    public function forgetCache(Setting $setting): void
    {
        Cache::forget($this->cacheKey($setting->key));
    }

    private function cacheKey(string $key): string
    {
        return self::CACHE_PREFIX . $key;
    }
}
