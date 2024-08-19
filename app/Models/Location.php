<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Location extends Model
{
    use CrudTrait;

    protected $table = 'locations';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'LocationName', 'AddressLine1', 'AddressLine2', 'City', 'State', 'PostalCode',
        'Country', 'Phone', 'Latitude', 'Longitude', 'OpeningHours', 'Description'
    ];
}
