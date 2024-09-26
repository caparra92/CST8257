<?php
/**
 * Author: Camilo Parra
 * Student Number: 041117912
 */

error_reporting(E_ALL);
extract($_POST);
$interestRate = 3;
// $yearsToDeposit = $_POST['yearsToDeposit'];
// $name = $_POST['name'];
// $postalCode = $_POST['postalCode'];
// $phoneNumber = $_POST['phoneNumber'];
// $emailAddress = $_POST['emailAddress'];
// $btnCalculate = $_POST['calculate'];

$errorMsg = "";
$errors = array();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Deposit Calculation Results</title>
</head>
<body>
    <main>
        <section class="u-form">
            <? if(isset($calculate)) {
                if(!trim($principalAmount)) {
                    $errorMsg = "Principal Amount can not be blank";
                    array_push($errors, $errorMsg);
                } 
                if (!is_numeric($principalAmount)) {
                    $errorMsg = "Principal amount must be numeric and greater than 0";
                    array_push($errors, $errorMsg);
                } 
                if (!trim($yearsToDeposit)) {
                    $errorMsg = "You must select years to deposit";
                    array_push($errors, $errorMsg);
                } 
                if (!trim($name)) {
                    $errorMsg = "Name can not be blank";
                    array_push($errors, $errorMsg);
                } 
                if (!trim($postalCode)) {
                    $errorMsg = "Postal code can not be blank";
                    array_push($errors, $errorMsg);
                } 
                if (!trim($phoneNumber)) {
                    $errorMsg = "Phone number can not be blank";
                    array_push($errors, $errorMsg);
                } 
                if (!trim($emailAddress)) {
                    $errorMsg = "Email address can not be blank";
                    array_push($errors, $errorMsg);
                }

                if (isset($contactMethod)) {
                    if ($contactMethod == 'phone') {
                        if (!isset($time)) {
                            $errorMsg = "When preferred contact method is phone, you have to select one or more contact times";
                            array_push($errors, $errorMsg); 
                        }
                    }
                } else {
                    $errorMsg = "You must select a contact method";
                    array_push($errors, $errorMsg);
                }
            }
            
            if (is_numeric($principalAmount)) {
                $interestAmount = ($principalAmount * $interestRate) / 100;
            }
            ?>
            <h3>Thank you <? echo $name?>, for using our deposit calculator!</h3>
            <? $errorsLength = count($errors);
            if ($errorsLength > 0) {
                echo '<p> However, we can not process your request because of the following input errors:</p>';
                echo '<ul>';

                foreach ($errors as $error) {
                    echo '<li>'.$error.'</li>';
                }
                echo '</ul>';
            } else {
                if (trim($contactMethod)) {
                    if ($contactMethod == 'email') {
                        echo '<p>An email about the details of our GIC has been sent to '.$emailAddress.'</p>';
                    } else {
                        echo '<p>Our customer service department will call you tomorrow ';
                        foreach ($time as $t) {
                            echo '<span>'.$t.'</span>, ';
                        }
                        echo 'at '.$phoneNumber.'</p>';
                    }
                }
                echo '<p>The following is the calculation results at the current interest rate of '.$interestRate.'%:</p>
                    <table class="u-table">
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
    </main>
</body>
</html>