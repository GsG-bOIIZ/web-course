<?php
// 
//  PHP_EOL не работало, поэтому использовал <br> и \n
// 
require_once('./src/common.inc.php'); 

$requestSurveyLoader = new RequestSurveyLoader();
$surveyFileStorage = new SurveyFileStorage();

$survey = $requestSurveyLoader->createSurveyInfo();
echo 'Входящие параметры<br><br>';
SurveyPrinter::viewData($survey);
echo '<br>';

SurveyFileStorage::saveSurveyToFile($survey);

echo 'Пользователь, взятый из файла<br><br>';
$surveyFile = $surveyFileStorage->loadSurveyFromFile($survey);
SurveyPrinter::viewData($surveyFile);