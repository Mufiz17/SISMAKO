<?php
return [

/*
|--------------------------------------------------------------------------
| Cross-Origin Resource Sharing (CORS) Configuration
|--------------------------------------------------------------------------
|
| Here you may configure your settings for cross-origin resource sharing
| or "CORS". This determines what cross-origin operations may execute
| in web browsers. You are free to adjust these settings as needed.
|
*/

'paths' => ['api/*'],

'allowed_methods' => ['*'],

'allowed_origins' => ['*'], // tambahkan localhost:3000

'allowed_origins_patterns' => [],

'allowed_headers' => ['*'],

'exposed_headers' => [],

'max_age' => 0,

'supports_credentials' => false,

];