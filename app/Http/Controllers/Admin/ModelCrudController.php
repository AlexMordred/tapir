<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

class ModelCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel('App\Model');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/model');
        $this->crud->setEntityNameStrings('model', 'models');

        $this->crud->removeButton('create');
        $this->crud->removeButton('update');

        $this->crud->setColumns([
            [
                'label' => 'Make', // Table column heading
                'type' => 'select',
                'name' => 'make_id', // the column that contains the ID of that connected entity;
                'entity' => 'make', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\Make", // foreign key model
            ],
            'name'
        ]);
    }
}
