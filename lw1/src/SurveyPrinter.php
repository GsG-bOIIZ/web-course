<?php

class SurveyPrinter
{
    public function viewData(Survey $survey): void
    {
        echo
            'Email: ' . $survey->getEmail() . "<br>" .
            'First Name: ' . $survey->getFirstName() . "<br>" .
            'Last Name: ' . $survey->getLastName() . "<br>" .
            'Age: ' . $survey->getAge();
    }
}
