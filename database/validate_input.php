<?php


function validUsername($username) {
    return preg_match ("/^[a-zA-Z0-9.-_]+$/", $username);
}

function validName($name) {
    return preg_match ("/^[a-zA-Z0-9]+$/", $name);
}

function validPassword($password) {
    return preg_match ("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&_-]{8,}$/", $password);
}

function validEmail($email) {
    return preg_match("/^[a-zA-Z0-9.@-_]+$/", $email);
}


?>