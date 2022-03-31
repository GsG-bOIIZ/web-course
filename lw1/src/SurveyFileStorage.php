<?php

class SurveyFileStorage
{
    private const FOLDER_DATA = './data/';

    public function loadSurveyFromFile(string $email): ?Survey
    {
        $fileName = self::FOLDER_DATA . $email . '.txt';
        if ($email !== "" and file_exists($fileName))
        {
            $tempArray = file($fileName);
            $arrayData = [];
            foreach ($tempArray as $line)
            {
                $tempString = explode(': ', $line, 2);
                $arrayData[$tempString[0]] = isset($tempString[1]) ? $tempString[1] : null;
            }
            return new Survey($arrayData["Email"], $arrayData["First Name"], $arrayData["Last Name"], $arrayData["Age"]);
        }  
        else
        {
            return new Survey("Impossible email", null, null, null);
        }      
    }

    public function saveSurveyToFile(Survey $survey): void
    {
        $fileName = self::FOLDER_DATA . $survey->getEmail() . '.txt';
        
        if ($survey->getEmail() === "")
        {
            return;
        }
        if (file_exists($fileName))
        {
            $tempArray = file($fileName);
            if ($survey->getFirstName() !== null)
            {
                $tempArray[1] = "First Name: " . $survey->getFirstName() . "\n";
            }
            if ($survey->getLastName() !== null)
            {
                $tempArray[2] = "Last Name: " . $survey->getLastName() . "\n";
            }
            if ($survey->getAge() !== null)
            {
                $tempArray[3] = "Age: " . $survey->getAge();
            }
            file_put_contents($fileName, $tempArray);
        }
        else
        {
            $surveyTxt = fopen($fileName, "w");
            fwrite($surveyTxt, "Email: " . $survey->getEmail() . "\n");
            fwrite($surveyTxt, "First Name: " . $survey->getFirstName() . "\n");
            fwrite($surveyTxt, "Last Name: " . $survey->getLastName() . "\n");            
            fwrite($surveyTxt, "Age: " . $survey->getAge());
            fclose($surveyTxt);
        }
    }   
}