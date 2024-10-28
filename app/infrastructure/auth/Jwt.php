<?php

namespace App\Infrastructure\Auth;

function base64UrlEncode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64UrlDecode($data) {
    $data .= str_repeat('=', (4 - strlen($data) % 4) % 4);
    return json_decode(base64_decode(strtr($data, '-_', '+/')), true);
}

function generateJwt($header, $payload, $secret) {
    $encodedHeader = base64UrlEncode(json_encode($header));
    $encodedPayload = base64UrlEncode(json_encode($payload));
    $signature = hash_hmac('sha256', "$encodedHeader.$encodedPayload", $secret, true);
    $encodedSignature = base64UrlEncode($signature);
    return "$encodedHeader.$encodedPayload.$encodedSignature";
}

function verifyJwt($jwt, $secret) {
    $parts = explode('.', $jwt);
    if (count($parts) !== 3) {
        return false;
    }

    list($encodedHeader, $encodedPayload, $encodedSignature) = $parts;
    $signature = hash_hmac('sha256', "$encodedHeader.$encodedPayload", $secret, true);
    $expectedSignature = base64UrlEncode($signature);

    if ($encodedSignature !== $expectedSignature) {
        return false;
    }

    $payload = base64UrlDecode($encodedPayload);
    if (isset($payload['exp']) && $payload['exp'] < time()) {
        return false;
    }

    return $payload;
}