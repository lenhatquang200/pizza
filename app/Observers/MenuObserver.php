<?php

namespace App\Observers;
use Illuminate\Support\Facades\Storage;

use App\Models\Menu;

class MenuObserver
{
    /**
     * Handle the Menu "created" event.
     */
    public function created(Menu $menu): void
    {
        //
    }

    /**
     * Handle the Menu "updated" event.
     */
    public function updated(Menu $menu): void
    {
        //
    }

    /**
     * Handle the Menu "deleted" event.
     */
    public function deleted(Menu $menu)
    {
        if ($menu->pdf_path) {
            Storage::disk('public')->delete($menu->pdf_path);
        }
        if ($menu->image_path) {
            Storage::disk('public')->delete($menu->image_path);
        }
    }

    /**
     * Handle the Menu "restored" event.
     */
    public function restored(Menu $menu): void
    {
        //
    }

    /**
     * Handle the Menu "force deleted" event.
     */
    public function forceDeleted(Menu $menu): void
    {
        //
    }
}
