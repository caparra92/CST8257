<?php
/**
* Author: Camilo Parra
* Student Number: 041117912
*/
include_once './Models/Student.php';

function getPDO() {

$dbConnection = parse_ini_file('Lab5.ini');

extract($dbConnection);

return new PDO($dsn, $user, $password);

}

function getStudent($studentId, $password) {
    
    $pdo = getPDO();
    $passSql = "SELECT Password FROM Student WHERE StudentId = '$studentId'";
    $resultSetPass = $pdo->query($passSql);
    $passRow = $resultSetPass->fetch(PDO::FETCH_ASSOC);
    if ($passRow) {
        $hash = $passRow['Password'];
        if (password_verify($password, $hash)) {
            // echo 'Valid pass';
            $sql = "SELECT StudentId, Name, Phone FROM Student WHERE StudentId = '$studentId' AND Password = '$hash'";
            $resultSet = $pdo->query($sql);
            // $resultSet->debugDumpParams();
            if($resultSet) {
                $row = $resultSet->fetch(PDO::FETCH_ASSOC);
                if($row) {
                    return new Student($row['StudentId'], $row['Name'], $row['Phone']);
                } else {
                    return null;
                }
            } else {
                throw new Exception("Query failed!, SQL statement: $sql");
            }
        } else {
            return null;
        }
    }
}

function addStudent($studentId, $name, $phone, $password)
{
    try {
        $pdo = getPDO();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Student (StudentId, Name, Phone, Password) VALUES( '$studentId', '$name', '$phone', '$password')";
        $pdoStmt = $pdo->query($sql);
    } catch (PDOException $ex) {
        die("Database error: " . $ex->getMessage());
    }
}
?>