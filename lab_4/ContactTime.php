<?php
/**
* Author: Camilo Parra
* Student Number: 041117912
*/

include 'Validations.php';
session_start();
extract($_POST);

if(!isset($_SESSION['name']))
    {
        header("Location: CustomerInfo.php");
        exit( );
    }

if(isset($next)) {
    if (!isset($time)) {
        $errors['contactTime'] = 'You have to select one or more contact times';
    } else {
        $_SESSION['contactTime'] = $time;
        header('Location: DepositCalculator.php');
    }
} else {
   if(isset($back)) {
        header('Location: CustomerInfo.php');
   }
}

include("./include/Header.php"); 
?>
<div class="container">
    <h1>Select Contact Times</h1>
    <form method="post" class="form">
        <div id="hourlyContactSection" class="container">
            <?
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
            echo '<h4>When can we contact you? Check all applicable:</h4>';
            foreach ($times as $timeSlot) {
                if(isset($_SESSION['contactTime']) && in_array($timeSlot, $_SESSION['contactTime'])) {
                    $isChecked = 'checked';
                } else if(isset($time) && in_array($timeSlot, $time)) {
                    $isChecked = 'checked';
                } else {
                    $isChecked = '';
                }
                //$isChecked = $_SESSION['contactTime'] && in_array($timeSlot, $_SESSION['contactTime']) ? 'checked' : '';
                echo '<div class="form-group">
                            <input type="checkbox" name="time[]" value="'.$timeSlot.'" '.$isChecked.'>
                            <label class="form-label">'.$timeSlot.'</label>
                    </div>';
            }
            echo '</div>';

            ?>
        </div>
        <div class="text-danger">
                <? if (isset($errors['contactTime'])) {echo $errors['contactTime'];} ?>
            </div>
        <div class="form-group">
            <button id="btnBack" class="btn btn-success" name="back">< Back</button>
            <button type="submit" id="btnNext" class="btn btn-success" name="next">Next ></button>
        </div>       
    </form>
</div>
<? include("./include/Footer.php"); ?>