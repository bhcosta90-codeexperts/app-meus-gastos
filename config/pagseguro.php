<?php

return [
    'email' => env('PAGSEGURO_EMAIL'),
    'token' => env('PAGSEGURO_TOKEN'),
    'env' => env('PAGSEGURO_ENV'),
    'timeout' => env('PAGSEGURO_TIMEOUT', 10),
];
