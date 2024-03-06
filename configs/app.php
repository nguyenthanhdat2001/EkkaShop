<?php
$config['app'] = [
    'globalMiddleware' => [
        Authentication::class
    ],
    'routeMiddleware' => [
        'my-account' => AuthIsLogin::class,
        'checkout' => AuthIsLogin::class,
        'orderDetail/(.+)' => AuthIsLogin::class,
        'updateUserCurrent' => AuthIsLogin::class,
        'checkout-final' => AuthIsLogin::class,
        'payment-final' => AuthIsLogin::class,
        'update-order-status' => AuthIsLogin::class,

        'admin/add-user' => Authorization::class,
        'admin/update-user/(.+)' => Authorization::class,
        'admin/delete-user' => Authorization::class,

        'admin/hide-product-rating' => Authorization::class,
        'admin/add-role' => Authorization::class,
        'admin/update-role/(.+)' => Authorization::class,
        'admin/delete-role' => Authorization::class,
    ],

    'boot' => [
        AppServiceProvider::class
    ]
];
