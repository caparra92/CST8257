<?php
/**
 * Author: Camilo Parra
 * Student Number: 041117912
 */
include 'functions.php';
error_reporting(E_ALL);
extract($_POST);
$interestRate = 3;

if(isset($calculate)) {
    if(isset($principalAmount)) { ValidatePrincipal($principalAmount, $errors);}
    if(isset($yearsToDeposit)) { ValidateYears($yearsToDeposit, $errors);}
    if(isset($name)) { ValidateName($name, $errors);}
    if(isset($postalCode)) { ValidatePostalCode($postalCode, $errors);}
    if(isset($phoneNumber)) { ValidatePhone($phoneNumber, $errors);}
    if(isset($emailAddress)) { ValidateEmail($emailAddress, $errors);}
    if(isset($contactMethod)) { 
        ValidateContactMethod($contactMethod, $time, $errors);
    } else {
        $errors['contactMethod'] = 'Please select a contact method';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Deposit Calculator</title>
</head>
<body>
    <header>
        <h2>Deposit Calculator</h2>
    </header>
    <main class="wrapper">
    <section class="u-container">
            <form action="/depositCalculator.php" method="post" class="u-form">
                <div class="u-input">
                    <label for="principalAmount">Principal Amount</label>
                    <input 
                    type="text" 
                    name="principalAmount" 
                    id="principalAmount"  
                    placeholder="Insert numeric value greater than 0"
                    value=<? if (isset($principalAmount)) echo $principalAmount ?>
                    >
                    <span class="u-error">
                    <? if (isset($errors['principalAmount'])) {echo $errors['principalAmount'];} ?>
                    </span>
                </div>
                <div class="u-input">
                    <label for="yearsToDeposit">Years to Deposit</label>
                    <select name="yearsToDeposit" id="yearsToDeposit">
                        <option value="">Select one...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <? if (isset($yearsToDeposit)) echo '<option value="'.$yearsToDeposit.'" selected>'.$yearsToDeposit.'</option>' ?>
                    </select>
                    <span class="u-error">
                        <? if (isset($errors['yearsToDeposit'])) {echo $errors['yearsToDeposit'];} ?>
                    </span> 
                </div>
                <hr>
                <div class="u-input">
                    <label for="name">Name</label>
                    <input 
                    type="text" 
                    name="name" 
                    id="name"
                    value=<? if (isset($name)) echo $name ?>
                    >
                    <span class="u-error">
                        <? if (isset($errors['name'])) {echo $errors['name'];} ?>
                    </span>
                </div>
                <div class="u-input">
                    <label for="postalCode">Postal Code</label>
                    <input 
                    type="text" 
                    name="postalCode" 
                    id="postalCode" 
                    placeholder="XnX XnX or XnXXnX"
                    value=<? 
                    if (isset($postalCode)) echo $postalCode;
                    if(isset($clear)) echo ''; 
                    ?>
                    >
                    <span class="u-error">
                        <? if (isset($errors['postalCode'])) {echo $errors['postalCode'];} ?>
                    </span>
                </div>
                <div class="u-input">
                    <label for="phoneNumber">Phone Number</label>
                    <input 
                    type="text" 
                    name="phoneNumber" 
                    id="phoneNumber" 
                    placeholder="xxx-xxx-xxxx"
                    value=<? if (isset($phoneNumber)) echo $phoneNumber ?>
                    >
                    <span class="u-error">
                        <? if (isset($errors['phoneNumber'])) {echo $errors['phoneNumber'];} ?>
                    </span>
                </div>
                <div class="u-input">
                    <label for="emailAddress">Email Address</label>
                    <input 
                    type="text" 
                    name="emailAddress" 
                    id="emailAddress" 
                    placeholder="abc@example.com"
                    value=<? if (isset($emailAddress)) echo $emailAddress ?>
                    >
                    <span class="u-error">
                        <? if (isset($errors['emailAddress'])) {echo $errors['emailAddress'];} ?>
                    </span>
                </div>
                <hr>
                <div class="u-input u-input-radio">
                    
                    <span>Preferred Contact Method</span>
                    <div>
                        <label for="contactMethodPhone">Phone</label>
                        <input 
                        type="radio" 
                        name="contactMethod" 
                        id="contactMethodPhone" 
                        value="phone"
                        <? if (isset($contactMethod) && $contactMethod == "phone") echo 'checked';?>
                        >
                        <label for="contactMethodEmail">Email</label>
                        <input 
                        type="radio" 
                        name="contactMethod" 
                        id="contactMethodEmail" 
                        value="email"
                        <? if (isset($contactMethod) && $contactMethod == "email") echo 'checked';?>
                        >
                        
                    </div>
                    <span class="u-error">
                        <? if (isset($errors['contactMethod'])) {echo $errors['contactMethod'];} ?>
                    </span>
                </div>
                <div id="hourlyContactSection" class="u-container">
                    <?
                    if (isset($contactMethod) && $contactMethod == "phone") {
                        $times = [
                            '9:00 am - 10:00 am',
                            '10:00 am - 11:00 am',
                            '11:00 am - 12:00 pm',
                            '12:00 pm - 1:00 pm',
                            '1:00 pm - 2:00 pm',
                            '2:00 pm - 3:00 pm',
                            '3:00 pm - 4:00 pm',
                            '4:00 pm - 5:00 pm',
                            '5:00 pm - 6:00 pm'
                        ];
                        echo '<div>';
                        echo '<h3>When can we contact you? Check all applicable:</h3>';
                        foreach ($times as $timeSlot) {
                            $isChecked = isset($time) && in_array($timeSlot, $time) ? 'checked' : '';
                            echo '<div class="u-input-chk">
                                        <input type="checkbox" name="time[]" value="'.$timeSlot.'" '.$isChecked.'>
                                        <label>'.$timeSlot.'</label>
                                </div>';
                        }
                        echo '</div>';
                    }
                    ?>
                </div>
                <div class="u-btn-group">
                    <button type="submit" id="btnSubmit" class="u-btn" name="calculate">Calculate</button>
                    <button id="btnClear" class="u-btn" type="button" name="clear">Clear</button>
                </div>           
            </form>
        </section>
        <section class="u-form" id="calcResultSection">
            <?
            if(isset($calculate) && count($errors) == 0) {
                if (is_numeric($principalAmount)) {
                    $interestAmount = ($principalAmount * $interestRate) / 100;
                } 
                echo '<h3>Thank you '.$name.', for using our deposit calculator!</h3>';
                
                if ($contactMethod == 'email') {
                    echo '<p>An email about the details of our GIC has been sent to '.$emailAddress.'</p>';
                } else {
                    echo '<p>Our customer service department will call you tomorrow ';
                    foreach ($time as $t) {
                        echo '<span>'.$t.'</span>, ';
                    }
                    echo 'at '.$phoneNumber.'</p>';
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
<script src="js/script.js"></script>
</body>
</html>