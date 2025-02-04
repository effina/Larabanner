<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | Number of items to show per page in the banner management interface.
    |
    */
    'pagination' => 15,

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | This is the URI prefix where banner management will be available.
    |
    */
    'route_prefix' => 'banners',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | The middleware to be applied to the banner management interface.
    |
    */
    'middleware' => ['web', 'auth'],
];
