<?php

$app->match('/index/{id}', 'App\Controller\indexController::indexAction');
	
$app->match('/addconge/{id}', 'App\Controller\congeController::addAction');
	
$app->match('/updtconge/{cid}/{updt}', 'App\Controller\congeController::updtAction');

$app->match('/employee/{id}', 'App\Controller\employeeController::viewAction');
