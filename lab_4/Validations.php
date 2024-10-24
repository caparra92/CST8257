<?
/**
* Author: Camilo Parra
* Student Number: 041117912
*/

$errors = array();


function ValidateTerms($readAndAgree, &$errors) {
    if (!isset($readAndAgree)) {
        $errors['readAndAgree'] = 'You must agree the terms and conditions!';
    }
} 

function ValidateName($name, &$errors) {
    if(empty($name)) {$errors['name'] = 'Name cannot be empty';}
}

function ValidatePostalCode($postalCode, &$errors) {
    if(empty($postalCode)) {
        $errors['postalCode'] = 'Postal Code cannot be empty';
    } else {
        if(!preg_match("/^[a-zA-Z]\d[a-zA-Z]\s?\d[a-zA-Z]\d$/",$postalCode)) {
            $errors['postalCode'] = 'Not a valid postal code'; 
        }
    }
}

function ValidatePhone($phone, &$errors) {
    if(empty($phone)) {
        $errors['phoneNumber'] = 'Phone cannot be empty';
    }
    if(trim($phone)) {
        if(!preg_match("/^[1-9]\d{2}-[1-9]\d{2}-\d{4}$/", $phone)) {
            $errors['phoneNumber'] = 'Not a valid phone number';
        }
    }
}

function ValidateEmail($email, &$errors) {
    if(empty($email)) {
        $errors['emailAddress'] = 'Email cannot be empty';
    }
    if(trim($email)) {
        if(!preg_match("/^[\w.]+@[a-zA-Z.]+(\.[a-zA-Z]{2,4})$/", $email)) {
            $errors['emailAddress'] = 'Not a valid email';
        }
    }
}

function ValidatePrincipal($amount, &$errors) {
    if(empty($amount)) {
        $errors['principalAmount'] = 'Principal Amount cannot be empty';
    } else if(!is_numeric($amount) || $amount <= 0) { 
        $errors['principalAmount'] = 'Principal amount must be numeric and greater than 0'; 
    }
    
}

function ValidateYears($years, &$errors) {

    $min = 1;
    $max = 25;

    if(empty($years)) {
        $errors['yearsToDeposit'] = 'Please select a number of years';
    } else if(is_numeric($years) ) { 
        if(($min > $years) || ($years > $max)) {
            $errors['yearsToDeposit'] = 'Please select a value between 1 and 25'; 
        }
    } 
}

?>