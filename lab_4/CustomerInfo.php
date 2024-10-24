<?php
/**
* Author: Camilo Parra
* Student Number: 041117912
*/

include 'Validations.php';

error_reporting(E_ALL);
extract($_POST);
session_start();

if(!isset($_SESSION['readAndAgree']))
    {
        header("Location: Disclaimer.php");
        exit( );
    }

if(isset($next)) {
    if(isset($name)) { ValidateName($name, $errors);}
    if(isset($postalCode)) { ValidatePostalCode($postalCode, $errors);}
    if(isset($phoneNumber)) { ValidatePhone($phoneNumber, $errors);}
    if(isset($emailAddress)) { ValidateEmail($emailAddress, $errors);}
    if(!isset($contactMethod)) { 
        $errors['contactMethod'] = 'Please select a contact method';
    } else {
        $_SESSION['contactMethod'] = $contactMethod;
        $_SESSION['name'] = $name;
        $_SESSION['postalCode'] = $postalCode;
        $_SESSION['phoneNumber'] = $phoneNumber;
        $_SESSION['emailAddress'] = $emailAddress;
        if ($contactMethod == 'phone' && count($errors) == 0) {
            header('Location: ContactTime.php');
        } else if ($contactMethod == 'email' && count($errors) == 0){
            header('Location: DepositCalculator.php');
        }
    }
}

include("./include/Header.php"); 
?>
<div class="container">
    <div class="row">
        <h1 class="text-left">Customer Information</h1>
        <div class="col-md-8">
            <form method="post" class="form row">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="name">Name</label>
                    <div class="col-sm-7">
                        <input
                        class="form-control" 
                        type="text" 
                        name="name" 
                        id="name"
                        value="<? if (isset($_SESSION['name'])) { 
                                    echo $_SESSION['name'];
                                } else if (isset($name)) {
                                    echo $name;
                                }
                                ?>"
                        >
                    </div>
                    <span class="text-danger col-sm-3">
                        <? if (isset($errors['name'])) {echo $errors['name'];} ?>
                    </span>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="postalCode">Postal Code</label>
                    <div class="col-sm-7">
                        <input
                        class="form-control" 
                        type="text" 
                        name="postalCode" 
                        id="postalCode" 
                        placeholder="XnX XnX or XnXXnX"
                        value="<? 
                                if (isset($_SESSION['postalCode'])) { 
                                    echo trim($_SESSION['postalCode']);
                                } else if (isset($postalCode)) {
                                    echo $postalCode;
                                }
                        ?>"
                        >
                    </div>
                    <span class="text-danger col-sm-3">
                        <? if (isset($errors['postalCode'])) {echo $errors['postalCode'];} ?>
                    </span>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="phoneNumber">Phone Number</label>
                    <div class="col-sm-7">
                        <input
                        class="form-control" 
                        type="text" 
                        name="phoneNumber" 
                        id="phoneNumber" 
                        placeholder="xxx-xxx-xxxx"
                        value=<? 
                                if (isset($_SESSION['phoneNumber'])) { 
                                    echo $_SESSION['phoneNumber'];
                                } else if (isset($phoneNumber)) {
                                    echo $phoneNumber;
                                }
                        ?>
                        >
                    </div>
                    <span class="text-danger col-sm-3">
                        <? if (isset($errors['phoneNumber'])) {echo $errors['phoneNumber'];} ?>
                    </span>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="emailAddress">Email Address</label>
                    <div class="col-sm-7">
                        <input
                        class="form-control" 
                        type="text" 
                        name="emailAddress" 
                        id="emailAddress" 
                        placeholder="abc@example.com"
                        value=<? 
                            if (isset($_SESSION['emailAddress'])) { 
                                echo $_SESSION['emailAddress'];
                            } else if (isset($emailAddress)) {
                                echo $emailAddress;
                            }
                        ?>
                        >
                    </div>
                    <span class="text-danger col-sm-3">
                        <? if (isset($errors['emailAddress'])) {echo $errors['emailAddress'];} ?>
                    </span>
                </div>
                <hr>
                <div class="col-auto my-1">
                    
                    <span>Preferred Contact Method</span>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="contactMethodPhone">Phone</label>
                        <input
                        class="form-check-input"
                        type="radio" 
                        name="contactMethod" 
                        id="contactMethodPhone" 
                        value="phone"
                        <? 
                            if (isset($_SESSION['contactMethod']) && $_SESSION['contactMethod'] == 'phone') { 
                                echo 'checked';
                            } else if (isset($contactMethod) && $contactMethod == "phone") {
                                echo 'checked';
                            }
                        ?>
                        >
                        <label class="form-check-label" for="contactMethodEmail">Email</label>
                        <input 
                        class="form-check-input"
                        type="radio" 
                        name="contactMethod" 
                        id="contactMethodEmail" 
                        value="email"
                        <? 
                            if (isset($_SESSION['contactMethod']) && $_SESSION['contactMethod'] == 'email') { 
                                echo 'checked';
                            } else if (isset($contactMethod) && $contactMethod == "email") {
                                echo 'checked';
                            }
                        ?>
                        >
                        
                    </div>
                    <span class="text-danger">
                        <? if (isset($errors['contactMethod'])) {echo $errors['contactMethod'];} ?>
                    </span>
                </div>
                <button type="submit" id="next" class="btn btn-success" name="next">Next ></button>
            </form>
        </div>
    </div>
</div>
<? include("./include/Footer.php"); ?>