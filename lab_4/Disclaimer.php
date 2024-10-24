<? 
/**
* Author: Camilo Parra
* Student Number: 041117912
*/

include 'Validations.php';
error_reporting(E_ALL);
session_start();
extract($_POST);

if(isset($start)) {
    if(isset($readAndAgree)) {
        $_SESSION['readAndAgree'] = $readAndAgree;
        header('Location: CustomerInfo.php');
    } else {
        $errors['readAndAgree'] = 'You must agree the terms and conditions!';
    }
} else {
    if(isset($_SESSION["readAndAgree"])) {
        $readAndAgree = $_SESSION["readAndAgree"];
    }
}
include("./include/Header.php"); 
?>
<div class="container">
    <div class="d-flex justify-content-center">
        <h1 class="text-center">Terms and Conditions</h1>
        <div class="text-left">
            <p>
                I agree to abide by the Bank's Terms and Conditions and rules in force and the changes thereto in Terms and Consitions from time to time relating to my account
                as communicated and made available on the Bank's website
            </p>
            <p>
                I agree that the bank before opening any deposit account, will carry out a due dilligence as required under Know Your Customer guidelines of the bank. I would be required to submit necessary documents or proofs,
                such as identity, address, photograph and any such information. I agree to submit the above documents again at periodic intervals as may be required by the Bank.
            </p>
            <p>
                I agree that the Bank can at its sole discretion, amend any of the services/facilities given in my account either wholly or partially at any time by giving me at least 30 days notice and/or provide an option to me to switch to other services/facilities.
            </p>
        </div>
    </div>
    <form class="form" method="post">
        <div class="form-group">
            <div class="text-danger">
                <? if (isset($errors['readAndAgree'])) {echo $errors['readAndAgree'];} ?>
            </div>
            <input type="checkbox" name="readAndAgree" id="readAndAgree"> 
            <label for="readAndAgree">I have read and agree with the terms and conditions</label>
        </div>
        <button type="submit" class="btn btn-success" name="start">Start</button>
    </form>
</div>
<? include("./include/Footer.php"); ?>