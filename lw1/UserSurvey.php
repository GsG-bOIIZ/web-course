<?php
// 
//  PHP_EOL не работало, поэтому использовал <br> и \n
// 
require_once('./src/common.inc.php'); 

$requestSurveyLoader = new RequestSurveyLoader();
$surveyPrinter = new SurveyPrinter();
$surveyFileStorage = new SurveyFileStorage();

$survey = $requestSurveyLoader->createSurveyInfo();

echo 'Входящие параметры<br><br>';
$surveyPrinter->viewData($survey);
echo '<br><br>';

$surveyFileStorage->saveSurveyToFile($survey);

echo 'Пользователь, взятый из файла<br><br>';
$surveyFile = $surveyFileStorage->loadSurveyFromFile($survey->getEmail());
$surveyPrinter->viewData($surveyFile);