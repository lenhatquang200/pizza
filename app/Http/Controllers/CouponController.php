<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        $sliderId = 'coupon-slider';
        return view('coupons.index', compact('coupons','sliderId'));
    }

    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupons.show', compact('coupon'));
    }
}
