<?php

$env = realpath(__DIR__ . '/../.env');

if ($env && file_exists($env) && is_readable($env)) {
    $lines = file($env, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Saltar líneas de comentarios
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        // Eliminar comillas si están presentes en el valor
        $value = trim($value, '"\'');
        
        putenv("{$key}={$value}");
    }
}