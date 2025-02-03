<?php
use app\controllers\ApiExampleController;
use app\controllers\Controller;
use app\controllers\TableauDeBordController;

use flight\Engine;
use flight\net\Router;

$url=Flight::get('flight.base_url');
$Controller=new Controller($url);
$router->get('/', [ $Controller, 'index']);
$router->post('/connexionEleveur', [ $Controller, 'connexionEleveur']);  

$TableauDeBordController=new TableauDeBordController($url);
$router->get('/fermeFiltre', [ $TableauDeBordController, 'fermeFiltre']);   