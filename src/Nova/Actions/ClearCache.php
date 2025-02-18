<?php

namespace Letsgoi\LaravelSettings\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\ActionResponse;
use Letsgoi\LaravelSettings\Models\Setting;
use Letsgoi\LaravelSettings\Repository\SettingRepository;

class ClearCache extends Action
{
    use InteractsWithQueue;
    use Queueable;

    /** @var string */
    public $confirmButtonText = 'Clear';

    /** @var string */
    public $confirmText = 'Do you want to clear all cache?';

    /** @var string */
    public $name = 'Clear cache';

    /**
     * @return mixed
     */
    public function handle(): ActionResponse
    {
        $settingsRepository = app(SettingRepository::class);

        Setting::each(static function (Setting $setting) use ($settingsRepository) {
            $settingsRepository->forgetCache($setting);
        });

        return Action::message('Cache cleared');
    }
}
