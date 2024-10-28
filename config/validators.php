<?php

function validateLoginFields($username, $password): bool {
    return !empty(trim($username)) && !empty(trim($password));
}

function validateRegisterFields($username, $password, $email): bool {
    return !empty(trim($username)) && !empty(trim($password)) && !empty(trim($email));
}