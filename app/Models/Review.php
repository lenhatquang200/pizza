<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Review extends Model
{
    use CrudTrait;

    protected $table = 'reviews';
    public $timestamps = false;

    protected $fillable = ['reviewtext', 'pagename', 'reviewdate', 'author'];
}

