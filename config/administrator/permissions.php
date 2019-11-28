<?php

use Spatie\Permission\Models\Permission;

return [
    'title'   => 'Permissions',
    'single'  => 'permission',
    'model'   => Permission::class,

    'permission' => function () {
        return Auth::user()->can('manage_users');
    },

    // Set CRUD permissions.
    'action_permissions' => [
        // Control the display of "New" button
        'create' => function ($model) {
            return true;
        },
        // Enable updating
        'update' => function ($model) {
            return true;
        },
        // Disable deleting
        'delete' => function ($model) {
            return false;
        },
        // Enable viewing
        'view' => function ($model) {
            return true;
        },
    ],

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'    => 'Permission',
        ],
        'operation' => [
            'title'    => 'Operation',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => 'Permission',

            // Set hint message
            'hint' => 'Changes of permission may impact the call of code, please modify carefully.'
        ],
        'roles' => [
            'type' => 'relationship',
            'title' => 'Role',
            'name_field' => 'name',
        ],
    ],

    'filters' => [
        'name' => [
            'title' => 'Permission',
        ],
    ],
];