<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Car extends Model
{
    use CrudTrait;

    protected $guarded = [];

    public function make()
    {
        return $this->belongsTo('App\Make');
    }

    public function model()
    {
        return $this->belongsTo('App\Model');
    }
}
