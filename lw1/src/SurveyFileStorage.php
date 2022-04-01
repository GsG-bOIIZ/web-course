<?php

class SurveyFileStorage
{
    private const FOLDER_DATA = './data/';
    private const FILE_FIRST_NAME = "First Name";
    private const FILE_LAST_NAME = "Last Name";
    private const FILE_EMAIL = "Email";
    private const FILE_AGE = "Age";

    private function createFileName(Survey $survey): string
    {
        return self::FOLDER_DATA . $survey->getEmail() . '.txt';
    }

    public function loadSurveyFromFile(Survey $survey): Survey
    {
        $fileName = self::createFileName($survey);
        if (!$email and file_exists($fileName))
        {
            $tempArray = file($fileName);
            $arrayData = [];
            foreach ($tempArray as $line)
            {
                $tempString = explode(': ', $line);
                $arrayData[$tempString[0]] = $tempString[1] ?? null;
            }
            return new Survey(
                $arrayData[self::FILE_EMAIL], 
                $arrayData[self::FILE_FIRST_NAME], 
                $arrayData[self::FILE_LAST_NAME], 
                $arrayData[self::FILE_AGE]
            );
        }  
        else
        {
            echo "<br>Impossible email (load Survey from file)<br><br>";
            return new Survey(null, null, null, null);
        }      
    }

    public static function saveSurveyToFile(Survey $survey): void
    {        
        if (!$survey->getEmail())
        {
            echo "<br>Impossible email (for save Survey to file)<br><br>";
            return;
        }
        $fileName = self::createFileName($survey);
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
            if (!file_exists(self::FOLDER_DATA))
            {
                mkdir(self::FOLDER_DATA);
            }
            $surveyTxt = fopen($fileName, "w");
            fwrite($surveyTxt, "Email: " . $survey->getEmail() . "\n");
            fwrite($surveyTxt, "First Name: " . $survey->getFirstName() . "\n");
            fwrite($surveyTxt, "Last Name: " . $survey->getLastName() . "\n");            
            fwrite($surveyTxt, "Age: " . $survey->getAge());
            fclose($surveyTxt);
        }
    }   
}