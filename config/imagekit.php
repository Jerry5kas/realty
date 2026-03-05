<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ImageKit Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for ImageKit image management and CDN service
    |
    */

    'public_key' => env('IMAGEKIT_PUBLIC_KEY', 'public_SNDJOLT+ZF4vOpUoNbqQ/N4S6cM='),
    'private_key' => env('IMAGEKIT_PRIVATE_KEY', 'private_W3O2iRaYTE/YxGJSrw30eEfS+l0='),
    'url_endpoint' => env('IMAGEKIT_URL_ENDPOINT', 'https://ik.imagekit.io/area24onestorage/'),
];
