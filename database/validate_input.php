<?php


function validUsername($username) {
    return preg_match ("/^[a-zA-Z0-9.-_]{1,}$/", $username);
}

function validName($name) {
    return preg_match("/^[a-zA-Z\s]+$/", $name);
}

function validPassword($password) {
    return preg_match ("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&_-]{8,}$/", $password);
}

function validEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}


?>