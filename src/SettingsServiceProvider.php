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
        $this->publishes([
            $this->local('create_settings_table.php') => $this->project('create_settings_table.php'),
            $this->local('change_id_from_settings_table.php') => $this->project('change_id_from_settings_table.php'),
        ], 'migrations');
    }

    private function local(string $filename): string
    {
        return __DIR__ . '/../database/migrations/' . $filename;
    }

    private function project(string $filename): string
    {
        return database_path('migrations/' . date('Y_m_d_His') . '_' . $filename);
    }
}
