<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Make extends Model
{
    use CrudTrait;

    protected $guarded = [];
}
