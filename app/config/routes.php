<?php

use app\controllers\ApiExampleController;
use app\controllers\Controller;
use app\controllers\TableauDeBordController;
use app\controllers\SoldeController;

use app\controllers\AnimalsController;
use flight\Engine;
use flight\net\Router;

$url = Flight::get('flight.base_url');
$Controller = new Controller($url);
$router->get('/', [$Controller, 'index']);
$router->post('/connexionEleveur', [$Controller, 'connexionEleveur']);

$TableauDeBordController = new TableauDeBordController($url);
$router->get('/tableauDeBord', [$TableauDeBordController, 'tableauDeBord']);
$router->get('/fermeFiltre', [$TableauDeBordController, 'fermeFiltre']);

$SoldeController = new SoldeController($url);
$router->get('/solde', [$SoldeController, 'solde']);
$router->post('/depot', [$SoldeController, 'depot']);
$router->post('/achatAlimentation', [$SoldeController, 'achatAlimentation']);


$AnimalsController = new AnimalsController($url);
$router->get('/nourirView', [$AnimalsController, 'nourirView']);
$router->post('/nourrir', [$AnimalsController, 'nourrirAnimal']);
