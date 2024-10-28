<?php

require_once __DIR__ . '/envim.php';

return [
    'DB_HOST' => getenv('DB_HOST') ?: '127.0.0.1',
    'DB_PORT' => getenv('DB_PORT') ?: '3306',
    'DB_NAME' => getenv('DB_NAME') ?: 'rollpay_php_challenge',
    'DB_USER' => getenv('DB_USER') ?: 'root',
    'DB_PASS' => getenv('DB_PASSWORD') ?: '',
    
    'TOKEN_SECRET' => getenv('TOKEN_SECRET') ?: '1234567890',
];
