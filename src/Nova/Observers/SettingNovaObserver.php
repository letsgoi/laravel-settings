<?php

namespace Letsgoi\LaravelSettings\Nova\Observers;

use Illuminate\Support\Facades\Cache;
use Letsgoi\LaravelSettings\Models\Setting;

class SettingNovaObserver
{
    public function updated(Setting $setting): void
    {
        Cache::forget($setting->key);
    }
}
