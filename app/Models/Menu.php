<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'pdf_path',
        'image_path',
    ];
}
