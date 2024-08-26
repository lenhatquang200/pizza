<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use CrudTrait;
    protected $table = 'settings';

    protected $fillable = ['title', 'value', 'description', 'image'];

    public $timestamps = true;

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
