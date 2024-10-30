<?
/**
* Author: Camilo Parra
* Student Number: 041117912
*/

$errors = array();


function ValidateStudentId($studentId, &$errors) {
    if (empty($studentId)) {
        $errors['studentId'] = 'Student Id cannot be empty!';
    }
} 

function ValidateName($name, &$errors) {
    if(empty($name)) {$errors['name'] = 'Name cannot be empty';}
}

function ValidatePassword($password, &$errors) {
    if(empty($password)) {
        $errors['password'] = 'Password cannot be empty';
    }
    if(trim($password)) {
        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!.*\s).{6,}$/", $password)) {
            $errors['password'] = 'Password must contain: At least 6 char long, 1 Upper Case, 1 Lower Case, 1 Number';
        }
    }
}

function ValidatePasswordConfirm($password, $passwordConfirm, &$errors) {
    if(strcmp($password, $passwordConfirm) !== 0) {
        $errors['passwordConfirm'] = 'Passwords did not match';
    }
}

function ValidatePhone($phone, &$errors) {
    if(empty($phone)) {
        $errors['phoneNumber'] = 'Phone cannot be empty';
    }
    if(trim($phone)) {
        if(!preg_match("/^[1-9]\d{2}-[1-9]\d{2}-\d{4}$/", $phone)) {
            $errors['phoneNumber'] = 'Not a valid phone number: Use either xxx-xxx-xxx or xxxxxxxxx';
        }
    }
}

?>