<?php
/**
* Author: Camilo Parra
* Student Number: 041117912
*/

session_start();
include_once './Models/Student.php'; 
include_once 'Functions.php';
include 'Validations.php';

error_reporting(E_ALL);
extract($_POST);
// phpinfo();

if(isset($submit)) {
    try {
        if(isset($studentId) && isset($password)) { 
            
            ValidateStudentId($studentId, $errors);
            ValidatePassword($password, $errors);
            $student = getStudent($studentId, $password);
            // echo $student;
            if($student != null) {
                $_SESSION['student'] = $student;
                header("Location: CourseSelection.php");
                exit();
            } else {
                $errors['login'] = 'Incorrent User ID and Password Combination!';
            }
        }
    }
    catch(Exception $ex) {
        die('System currently not available, try again later');
    }

}


include("./include/Header.php"); 
?>
<div class="container">
    <div class="row">
        <h1 class="text-left">Log In</h1>
        <p>You need to <a href="NewUser.php">sign up</a> if you are a new user</p>
        <div class="col-md-8">
            <form method="post" class="form row">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="studentId">Student ID:</label>
                    <div class="col-sm-7">
                        <input
                        class="form-control" 
                        type="text" 
                        name="studentId" 
                        id="studentId"
                        value="<? if (isset($_SESSION['studentId'])) { 
                                    echo $_SESSION['studentId'];
                                } else if (isset($studentId)) {
                                    echo $studentId;
                                }
                                ?>"
                        >
                    </div>
                    <span class="text-danger col-sm-3">
                        <? if (isset($errors['studentId'])) {echo $errors['studentId'];} ?>
                    </span>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="password">Password</label>
                    <div class="col-sm-7">
                        <input
                        class="form-control" 
                        type="password" 
                        name="password" 
                        id="password"
                        value="<? 
                                if (isset($_SESSION['password'])) { 
                                    echo trim($_SESSION['password']);
                                } else if (isset($password)) {
                                    echo $password;
                                }
                                ?>"
                        >
                    </div>
                    <span class="text-danger col-sm-3">
                        <? if (isset($errors['password'])) {echo $errors['password'];} ?>
                    </span>
                </div>
                <span class="text-danger row">
                    <? if (isset($errors['login'])) {echo $errors['login'];} ?>
                </span>
                <div class="form-group mt-3">
                    <button type="submit" id="submit" class="btn btn-success" name="submit">Submit</button>
                    <button type="button" id="clear" class="btn btn-success" name="clear">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>
<? include("./include/Footer.php"); ?>