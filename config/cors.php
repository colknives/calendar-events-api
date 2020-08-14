<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
    'supports_credentials' => false,
    'allowed_origins' => ['*'],
    'allowed_headers' => ['*'],
    'allowed_methods' => ['*'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
    'exposed_headers' => [],
    'paths' => ['*'],
    'max_age' => 0
];
