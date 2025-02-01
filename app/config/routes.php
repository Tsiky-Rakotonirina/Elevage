<?php
use app\controllers\ApiExampleController;
use app\controllers\Controller;

use flight\Engine;
use flight\net\Router;

$url=Flight::get('flight.base_url');
$Controller=new Controller($url);
$router->get('/', [ $Controller, 'index']);  
