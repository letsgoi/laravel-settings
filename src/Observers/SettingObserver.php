<?php

namespace Letsgoi\LaravelSettings\Observers;

use Letsgoi\LaravelSettings\Models\Setting;
use Letsgoi\LaravelSettings\Repository\SettingRepository;

class SettingObserver
{
    public function __construct(
        private readonly SettingRepository $settingRepository,
    ) {
    }

    public function updated(Setting $setting): void
    {
        $this->settingRepository->forgetCache($setting);
    }
}
