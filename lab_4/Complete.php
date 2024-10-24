<?php
/**
* Author: Camilo Parra
* Student Number: 041117912
*/
error_reporting(E_ALL);
extract($_POST);
session_start();

if (!isset($_SESSION["name"]) && !isset($_SESSION['contactTime']))
    {
            header("Location: Disclaimer.php");
            exit();
    }
include("./include/Header.php");
?>
<div class="container">
    <h3>Thank you <strong class="text-success"><? echo $_SESSION['name']; ?></strong> for using our deposit calculation tool.</h3>
    <?
    if(isset($_SESSION['contactTime'])) {
        echo '<p>Our customer service department will call you tomorrow ';
        foreach ($_SESSION['contactTime'] as $t) {
            echo '<span>'.$t.'</span>, ';
        }
        echo 'at '.$_SESSION['phoneNumber'].'</p>';
    } else if(isset($_SESSION['emailAddress'])){
        echo '<p>An email about the details of our GIC has been sent to '.$_SESSION['emailAddress'].'</p>';
    }
    ?>
</div>
<?php session_destroy();?>
<? include("./include/Footer.php"); ?>