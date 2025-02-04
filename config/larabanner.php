// config/larabanner.php
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

    /*
    |--------------------------------------------------------------------------
    | Layout View
    |--------------------------------------------------------------------------
    |
    | If you want to use your own application layout, specify the view path here.
    | Set to null to use the default Larabanner layout.
    |
    | Example: 'layouts.admin' will use resources/views/layouts/admin.blade.php
    |
    */
    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Layout Sections
    |--------------------------------------------------------------------------
    |
    | If using a custom layout, define the sections that the content should
    | be rendered into. This allows for flexible integration with existing layouts.
    |
    */
    'sections' => [
        'content' => 'content',      // Main content section
        'title' => 'title',         // Page title section
        'scripts' => 'scripts',     // Additional scripts section
        'styles' => 'styles',       // Additional styles section
    ],
];
