<?php

use App\Models\User;

return [
    // Title
    'title'   => 'Users',

    // Model single, used for model creation
    'single'  => 'User',

    // Model: used for CRUD
    'model'   => User::class,

    // Set permission
    // True: show menu; False: hide menu
    'permission'=> function()
    {
        return Auth::user()->can('manage_users');
    },

    // Set columns
    'columns' => [

        // Column headers
        'id',

        'avatar' => [
            'title'  => 'Avatar',

            // Set output. Default: directly output data
            'output' => function ($avatar, $model) {
                return empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" width="40">';
            },

            // Disable sorting
            'sortable' => false,
        ],

        'name' => [
            'title'    => 'Username',
            'sortable' => false,
            'output' => function ($name, $model) {
                return '<a href="/users/'.$model->id.'" target=_blank>'.$name.'</a>';
            },
        ],

        'email' => [
            'title' => 'Email',
        ],

        'operation' => [
            'title'  => 'Operation',
            'sortable' => false,
        ],
    ],

    // Set single model form for data editing
    'edit_fields' => [
        'name' => [
            'title' => 'Username',
        ],
        'email' => [
            'title' => 'Email',
        ],
        'password' => [
            'title' => 'Password',
            'type' => 'password',
        ],
        'avatar' => [
            'title' => 'Avatar',
            'type' => 'image',
            'location' => public_path() . '/uploads/images/avatars/',
        ],
        'roles' => [
            'title'      => 'Role',
            'type'       => 'relationship',
            'name_field' => 'name',
        ],
    ],

    // Set filter
    'filters' => [
        'id' => [
            'title' => 'User ID',
        ],
        'name' => [
            'title' => 'Username',
        ],
        'email' => [
            'title' => 'Email',
        ],
    ],
];