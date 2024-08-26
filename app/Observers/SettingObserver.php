<?php

namespace App\Observers;

use App\Models\Setting;

class SettingObserver
{
    /**
     * Handle the Setting "created" event.
     */
    public function created(Setting $setting): void
    {
        //
    }

    /**
     * Handle the Setting "updated" event.
     */
    public function updated(Setting $setting): void
    {
        //
    }

    /**
     * Handle the Setting "deleted" event.
     */
    public function deleted(Setting $setting)
    {
        if ($setting->image) {
            Storage::disk('public')->delete($setting->image);
        }
    }

    /**
     * Handle the Setting "restored" event.
     */
    public function restored(Setting $setting): void
    {
        //
    }

    /**
     * Handle the Setting "force deleted" event.
     */
    public function forceDeleted(Setting $setting): void
    {
        //
    }
}
