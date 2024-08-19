<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class PageContent extends Model
{
    use CrudTrait;

    protected $table = 'pagecontent';
    public $timestamps = false;
    
    protected $fillable = ['pagename', 'content'];
}

