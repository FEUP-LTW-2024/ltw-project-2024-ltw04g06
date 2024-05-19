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
    return preg_match("/^[a-zA-Z0-9\s.\-_!]{1,21}$/", $title);
}

function validPrice($price) {
    return preg_match("/^[0-9.]+$/", $price);
}

function validPhoneNumber($phoneNumber) {
    return preg_match("/^[0-9]+$/", $phoneNumber);
}

function validCreditCardNumber($cardNumber) {
    $cardNumber = preg_replace('/\D/', '', $cardNumber);
    $len = strlen($cardNumber);
    $sum = 0;
    $alt = false;
    
    for ($i = $len - 1; $i >= 0; $i--) {
        $n = $cardNumber[$i];
        
        if ($alt) {
            $n *= 2;
            if ($n > 9) {
                $n = ($n % 10) + 1;
            }
        }
        
        $sum += $n;
        $alt = !$alt;
    }
    
    return ($sum % 10 == 0);
}

function validCVV($cvv) {
    return preg_match("/^\d{3,4}$/", $cvv);
}

function validExpiryDate($expiryDate) {
    if (!preg_match("/^(0[1-9]|1[0-2])\/(\d{2})$/", $expiryDate, $matches)) {
        return false;
    }
    
    $month = $matches[1];
    $year = '20' . $matches[2];  
    
    $currentYear = date('Y');
    $currentMonth = date('m');
    
    if ($year < $currentYear || ($year == $currentYear && $month < $currentMonth)) {
        return false;
    }
    
    return true;
}

function validateCreditCardForm($formData) {
    $errors = [];

    if (!validName($formData['cardName'])) {
        $errors[] = "Invalid card name.";
    }
    if (!validCreditCardNumber($formData['cardNumber'])) {
        $errors[] = "Invalid card number.";
    }
    if (!validExpiryDate($formData['expiryDate'])) {
        $errors[] = "Invalid expiry date.";
    }
    if (!validCVV($formData['cvv'])) {
        $errors[] = "Invalid CVV.";
    }

    return $errors;
}


?>