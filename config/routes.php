<?php

$routes = [
    'user' => [
        'home' => '/thedailygrind/index#home',
        'menu' => '/thedailygrind/views/menu',
        'contact' => '/thedailygrind/views/contact',
        'cart' => '/thedailygrind/views/cart',
        'profile' => '/thedailygrind/views/profile',
        'orders' => '/thedailygrind/views/orders',
        'login' => '/thedailygrind/views/auth/login',
        'register' => '/thedailygrind/views/auth/register',
        'receipt' => '/thedailygrind/views/receipt',
        'logout' => '/thedailygrind/controllers/logout',
        'update_profile' => '/thedailygrind/controllers/user/update_profile',
    ],

    'admin' => [
        'dashboard' => '/thedailygrind/admin/admin',
        'products' => '/thedailygrind/admin/products',
        'orders' => '/thedailygrind/admin/orders',
        'users' => '/thedailygrind/admin/users',
        'update_admin' => '/thedailygrind/controllers/admin/update_admin',
        'sold' => '/thedailygrind/admin/sold',
        'analytics' => '/thedailygrind/admin/analytics',
    ],

    'controllers' => [
        'addtocart' => '/thedailygrind/controllers/user/addtocart',
        'cart_process' => '/thedailygrind/controllers/user/cart_process',
        'process_order' => '/thedailygrind/controllers/user/process_order',
        'auth_controller' => '/thedailygrind/controllers/auth_controller',
        'product_controller' => '/thedailygrind/controllers/admin/productscontroller',
    ]
];

if (!function_exists('route')) {
    function route($type, $key)
    {
        global $routes;
        return isset($routes[$type][$key]) ? $routes[$type][$key] : 'javascript:void(0);';
    }
}
?>