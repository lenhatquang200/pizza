<?php
namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'banners';

    protected $fillable = ['url', 'imagetype', 'imageurl'];
    public$timestamps = false;
}

