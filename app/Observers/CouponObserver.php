<?php

namespace App\Observers;

use App\Models\Coupon;
use Illuminate\Support\Facades\Storage;

class CouponObserver
{
    /**
     * Handle the Coupon "created" event.
     */
    public function created(Coupon $coupon): void
    {
        //
    }

    /**
     * Handle the Coupon "updated" event.
     */
    public function updated(Coupon $coupon): void
    {
        //
    }

    /**
     * Handle the Coupon "deleted" event.
     */
    public function deleted(Coupon $coupon): void
    {
        if (Storage::disk('public')->exists($coupon->bannerurl)) {
            Storage::disk('public')->delete($coupon->bannerurl);
        }
    }

    /**
     * Handle the Coupon "restored" event.
     */
    public function restored(Coupon $coupon): void
    {
        //
    }

    /**
     * Handle the Coupon "force deleted" event.
     */
    public function forceDeleted(Coupon $coupon): void
    {
        //
    }
}
