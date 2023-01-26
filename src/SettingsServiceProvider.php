<?php

namespace Letsgoi\LaravelSettings;

class SettingsServiceProvider
{
    public function boot(): void
    {
        $this->registerPublishes();
    }

    private function registerPublishes(): void
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/create_settings_table.php' => database_path('migrations/' . date('Y_m_d_His') . '_create_settings_table.php'),
        ], 'migrations');
    }
}
