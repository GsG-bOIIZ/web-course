<?php

class RequestSurveyLoader
{
    public function createSurveyInfo(): Survey
    {
        $email = isset($_GET['email']) ? $_GET['email'] : null;
        $firstName = isset($_GET['first_name']) ? $_GET['first_name'] : null;
        $lastName = isset($_GET['last_name']) ? $_GET['last_name'] : null;   
        $age = isset($_GET['age']) ? $_GET['age'] : null;

        return new Survey($email, $firstName, $lastName, $age);
    }
}