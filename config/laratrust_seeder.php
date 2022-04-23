<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d,t,s',
            'roles' => 'c,r,u,d,t,s',
            'settings' => 'c,r,u,d,t,s',
            'countries' => 'c,r,u,d,t,s',
            'categories' => 'c,r,u,d,t,s',
            'products' => 'c,r,u,d,t,s',
            'orders' => 'c,r,u,d,t,s',
            'all_orders' => 'c,r,u,d,t,s',
            'addresses' => 'c,r,u,d,t,s',
            'reports' => 'c,r,u,d,t,s',
            'finances' => 'c,r,u,d,t,s',
            'wallet' => 'c,r,u,d,t,s',
            'notifications' => 'c,r,u,d,t,s',
            'shipping_rates' => 'c,r,u,d,t,s',
            'colors' => 'c,r,u,d,t,s',
            'sizes' => 'c,r,u,d,t,s',
            'withdrawals' => 'c,r,u,d,t,s',
            'notes' => 'c,r,u,d,t,s',
            'messages' => 'c,r,u,d,t,s',
            'slides' => 'c,r,u,d,t,s',
            'onotes' => 'c,r,u,d,t,s',
            'logs' => 'c,r,u,d,t,s',
        ],
        'administrator' => [],
        'vendor' => [],
        'affiliate' => [],
        'user' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        't' => 'trash',
        's' => 'restore',
    ]
];
