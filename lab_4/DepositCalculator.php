<?php
/**
* Author: Camilo Parra
* Student Number: 041117912
*/

include 'Validations.php';

error_reporting(E_ALL);
extract($_POST);
session_start();

if(!isset($_SESSION['name']))
{
    header("Location: CustomerInfo.php");
    exit( );
}

$interestRate = 3;
if(isset($calculate)) {
    if(isset($principalAmount)) { ValidatePrincipal($principalAmount, $errors);}
    if(isset($yearsToDeposit)) { ValidateYears($yearsToDeposit, $errors);}
    $_SESSION['principalAmount'] = $principalAmount;
    $_SESSION['yearsToDeposit'] = $yearsToDeposit;
} else if(isset($back)) {
    if($_SESSION['contactMethod'] == 'phone') {
        header('Location: ContactTime.php');
    } else if ($_SESSION['contactMethod'] == 'email') {
        header('Location: CustomerInfo.php');
    }
} else if(isset($complete)) {
    header('Location: Complete.php');
}

include("./include/Header.php"); 
?>
<div class="container">
    <h3>Enter principal amount, interest rate and select number of years to deposit</h3>
    <hr>
    <div class="row">
        <div class="col-md-8">
            <form method="post" class="form">
                <div class="row g-3 align-items-center form-group">
                    <div class="col-md-3">
                        <label for="principalAmount" class="col-form-label">Principal Amount</label>
                    </div>
                    <div class="col-md-6">
                        <input
                        class="form-control" 
                        type="text" 
                        name="principalAmount" 
                        id="principalAmount"  
                        placeholder="Insert numeric value greater than 0"
                        value="<? 
                            if (isset($_SESSION['principalAmount'])) { 
                                echo $_SESSION['principalAmount'];
                            } else if (isset($principalAmount)) {
                                echo $principalAmount;
                            }
                        ?>"
                        >
                    </div>
                    <div class="col-md-3">
                        <span class="text-danger">
                        <? if (isset($errors['principalAmount'])) {echo $errors['principalAmount'];} ?>
                        </span>
                    </div>
                </div>
                <div class="row g-3 align-items-center form-group">
                    <div class="col-md-3">
                        <label for="yearsToDeposit">Years to Deposit</label>
                    </div>
                    <div class="col-md-6">
                        <select name="yearsToDeposit" id="yearsToDeposit" class="form-control">
                            <option value="">Select one...</option>
                            <? for ($i = 1; $i <=25; $i++) {
                                echo "<option value='".$i."'>".$i." years</option>";
                            }
                            if (isset($_SESSION['yearsToDeposit'])) { 
                                echo "<option value='".$_SESSION['yearsToDeposit']."' selected>".$_SESSION['yearsToDeposit']." years</option>";
                            } else if (isset($yearsToDeposit)) {
                                echo "<option value='".$yearsToDeposit."' selected>".$yearsToDeposit." years</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <span class="text-danger">
                            <? if (isset($errors['yearsToDeposit'])) {echo $errors['yearsToDeposit'];} ?>
                        </span> 
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <button id="btnBack" class="btn btn-success" name="back">< Back</button>
                    <button type="submit" id="btnCalculate" class="btn btn-success" name="calculate">Calculate</button>
                    <button id="btnComplete" class="btn btn-success" name="complete">Complete ></button>
                </div>    
            </form>
        </div>
    </div>
</div>
<section class="container" id="calcResultSection">
    <?
    if(isset($calculate) && count($errors) == 0) {
        if (is_numeric($principalAmount)) {
            $interestAmount = ($principalAmount * $interestRate) / 100;
        } 
        echo '<h3>Thank you '.$_SESSION['name'].', for using our deposit calculator!</h3>';
        
        echo '<p>The following is the calculation results at the current interest rate of '.$interestRate.'%:</p>
            <table class="table table-hover">
            <thead>
                <th>Year</th>
                <th>Principal at Year Start</th>
                <th>Interest for the Year</th>
            </thead>
            <tbody>';
                
        for ($i = 1; $i <= $yearsToDeposit; $i++) {
    ?>
    <tr>
        <td><?print($i)?></td>
        <td><?printf('%.2f',$principalAmount)?></td>
        <td><?printf('%.2f',$interestAmount)?></td>
    </tr>
    <?
        $principalAmount = $principalAmount + $interestAmount;
        $interestAmount = ($principalAmount * $interestRate) / 100;
    }?>
                
    </tbody>    
    </table>
    <?}?>
</section>    

<? include("./include/Footer.php"); ?>