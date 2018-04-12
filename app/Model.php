<?php

namespace App;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Backpack\CRUD\CrudTrait;

class Model extends EloquentModel
{
    use CrudTrait;

    protected $guarded = [];

    protected $with = ['make'];

    public function make()
    {
        return $this->belongsTo('App\Make');
    }
}
