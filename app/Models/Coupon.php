<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'bannerurl',
        'url',
        'couponcode',
        'validfrom',
        'validto',
        'displayfrom',
        'displayto',
        'isfeatured',
        'descriptions'
    ];
}
