<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

class MakeCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel('App\Make');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/make');
        $this->crud->setEntityNameStrings('make', 'makes');

        $this->crud->removeButton('create');
        $this->crud->removeButton('update');

        $this->crud->setColumns(['name']);
    }
}
