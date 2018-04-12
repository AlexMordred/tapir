<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

class CarCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel('App\Car');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/car');
        $this->crud->setEntityNameStrings('car', 'cars');

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
            [
                'label' => 'Model', // Table column heading
                'type' => 'select',
                'name' => 'model_id', // the column that contains the ID of that connected entity;
                'entity' => 'model', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\Model", // foreign key model
            ],
            [
                'name' => 'data_id',
                'label' => 'ID'
            ]
        ]);
    }
}
