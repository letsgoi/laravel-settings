<?php

namespace Letsgoi\LaravelSettings\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\ActionResponse;

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
        Artisan::call('cache:clear');

        return Action::message('Cache cleared');
    }
}
