<?php

namespace Letsgoi\LaravelSettings;

use Illuminate\Support\ServiceProvider;
use Letsgoi\LaravelSettings\Models\Setting;
use Letsgoi\LaravelSettings\Observers\SettingObserver;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPublishes();

        Setting::observe(SettingObserver::class);
    }

    private function registerPublishes(): void
    {
        $path = 'migrations/' . date('Y_m_d_His') . '_create_settings_table.php';

        $this->publishes([
            __DIR__ . '/../database/migrations/create_settings_table.php' => database_path($path),
        ], 'migrations');
    }
}
