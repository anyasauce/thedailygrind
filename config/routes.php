<?php

$routes = [
    'user' => [
        'home' => BASE_URL . 'index#home',
        'menu' => BASE_URL . 'views/menu',
        'contact' => BASE_URL . 'views/contact',
        'cart' => BASE_URL . 'views/cart',
        'profile' => BASE_URL . 'views/profile',
        'orders' => BASE_URL . 'views/orders',
        'login' => BASE_URL . 'views/auth/login',
        'register' => BASE_URL . 'views/auth/register',
        'receipt' => BASE_URL . 'views/receipt',
        'logout' => BASE_URL . 'controllers/logout',
        'update_profile' => BASE_URL . 'controllers/user/update_profile',
    ],

    'admin' => [
        'dashboard' => BASE_URL . 'admin/admin',
        'products' => BASE_URL . 'admin/products',
        'orders' => BASE_URL . 'admin/orders',
        'users' => BASE_URL . 'admin/users',
        'update_admin' => BASE_URL . 'controllers/admin/update_admin',
        'sold' => BASE_URL . 'admin/sold',
        'analytics' => BASE_URL . 'admin/analytics',
    ],

    'controllers' => [
        'addtocart' => BASE_URL . 'controllers/user/addtocart',
        'cart_process' => BASE_URL . 'controllers/user/cart_process',
        'process_order' => BASE_URL . 'controllers/user/process_order',
        'auth_controller' => BASE_URL . 'controllers/auth_controller',
        'product_controller' => BASE_URL . 'controllers/admin/productscontroller',
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
