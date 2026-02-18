<?php

return [
    [
        'icon' => 'fas fa-tachometer-alt nav-icon',
        'route' => 'dashboard',
        'title' => 'Dashboard',
    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'categories.index',
        'title' => 'Categories',
        'ability' => 'categories.index',
    ],
    [
        'icon' => 'fas fa-box-open nav-icon',
        'route' => 'products.index',
        'title' => 'Products',
        'ability' => 'products.index',
    ],
    [
        'icon' => 'fas fa-store nav-icon',
        'route' => 'stores.index',
        'title' => 'Stores',
        'ability' => 'stores.index',
    ],
    [
        'icon' => 'fas fa-user-shield nav-icon',
        'route' => 'roles.index',
        'title' => 'Roles',
        'ability' => 'roles.index',
    ],
    [
        'icon' => 'fas fa-user-cog nav-icon',
        'route' => 'admins.index',
        'title' => 'Admins',
        'ability' => 'admins.index',
    ],
    [
        'icon' => 'fas fa-users nav-icon',
        'route' => 'users.index',
        'title' => 'Users',
        'ability' => 'users.index',
    ],
    [
        'icon' => 'fas fa-shopping-cart nav-icon',
        'route' => 'orders.index',
        'title' => 'Orders',
        'ability' => 'orders.index',
    ],

];
