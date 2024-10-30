<?php
/**
* Author: Camilo Parra
* Student Number: 041117912
*/
class Student {
    private string $studentId = '';
    private string $name = '';
    private string $phoneNumber = '';

    public function __construct($studentId, $name, $phoneNumber) {
        $this->studentId = $studentId;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
    }

    public function getStudentId() {
        return $this->studentId;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }
}
?>