<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use CrudTrait;
    use HasFactory;

    // Các trường được phép gán hàng loạt
    protected $fillable = [
        'bannerurl',
        'validfrom',
        'validto',
        'displayfrom',
        'displayto',
        'isfeatured',
    ];
}
