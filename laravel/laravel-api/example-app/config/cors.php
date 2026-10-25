<?php


return [
   'paths' => ['books', 'books/*', 'health'],
   'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
   'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173'],
   'allowed_origins_patterns' => [],
   'allowed_headers' => ['Content-Type', 'Accept'],
   'exposed_headers' => [],
   'max_age' => 0,
   'supports_credentials' => false,
];
