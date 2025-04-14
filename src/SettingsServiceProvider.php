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
        $migrationNames = [
            'create_settings_table.php',
            'change_id_from_settings_table.php',
            'alter_value_from_string_to_text_from_settings_table.php',
        ];

        $migrations = [];

        foreach ($migrationNames as $key => $migrationName) {
            $migrations[$this->local($migrationName)] = $this->project($key . '_' . $migrationName);
        }

        $this->publishes($migrations, 'migrations');
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
