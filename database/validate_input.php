<?php


function validUsername($username) {
    return preg_match ("/^[a-zA-Z0-9.-_]{1,20}$/", $username);
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

function validCatConSize($field) {
    return preg_match("/^.{1,30}$/", $field);
}

function validAboutMe($aboutMe) {
    return preg_match("/^.{0,70}$/", $aboutMe);
}

function validTitle($title) {
    return preg_match("/^[a-zA-Z0-9.-_]{1,35}$/", $title);
}

function validDescription($description) {
    return preg_match("/^.{1,300}$/", $description);
}

function validPrice($price) {
    return preg_match("/^[0-9.]+$/", $price);
}


?>