<?php

use Spatie\Permission\Models\Role;

return [
    'title'   => 'Roles',
    'single'  => 'Role',
    'model'   => Role::class,

    'permission'=> function()
    {
        return Auth::user()->can('manage_users');
    },

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => 'Role'
        ],
        'permissions' => [
            'title'  => 'Permission',
            'output' => function ($value, $model) {
                $model->load('permissions');
                $result = [];
                foreach ($model->permissions as $permission) {
                    $result[] = $permission->name;
                }

                return empty($result) ? 'N/A' : implode(' | ', $result);
            },
            'sortable' => false,
        ],
        'operation' => [
            'title'  => 'Operation',
            'output' => function ($value, $model) {
                return $value;
            },
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => 'Role',
        ],
        'permissions' => [
            'type' => 'relationship',
            'title' => 'Permission',
            'name_field' => 'name',
        ],
    ],

    'filters' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => 'Role',
        ]
    ],

    // Rules for creation and editing
    'rules' => [
        'name' => 'required|max:15|unique:roles,name',
    ],

    // Error message according to rules
    'messages' => [
        'name.required' => 'Role cannot be null',
        'name.unique' => 'Role has exited',
    ]
];