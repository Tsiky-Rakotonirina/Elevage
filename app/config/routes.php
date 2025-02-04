<?php

use app\controllers\ApiExampleController;
use app\controllers\Controller;
use app\controllers\TableauDeBordController;
use app\controllers\SoldeController;
use app\controllers\AchatController;
use app\controllers\AdminEspeceController;
use app\controllers\AdminAnimalController;

use flight\Engine;
use flight\net\Router;

$url=Flight::get('flight.base_url');
$Controller=new Controller($url);
$router->get('/', [ $Controller, 'index']);
$router->post('/connexionEleveur', [ $Controller, 'connexionEleveur']);  
$router->post('/reinitialiser', [ $Controller, 'reinitialiser']); 
$router->post('/connexionAdmin', [ $Controller, 'connexionAdmin']);  
$router->get('/menuAdmin', [ $Controller, 'menuAdmin']);  
$router->get('/deconnection', [ $Controller, 'deconnectionEleveur']);  


$TableauDeBordController = new TableauDeBordController($url);
$router->get('/tableauDeBord', [$TableauDeBordController, 'tableauDeBord']);
$router->get('/fermeFiltre', [$TableauDeBordController, 'fermeFiltre']);

$SoldeController=new SoldeController($url);
$router->get('/solde',[$SoldeController,'solde']);
$router->post('/depot',[$SoldeController,'depot']);
$router->post('/achatAlimentation',[$SoldeController,'achatAlimentation']);

$AchatController=new AchatController($url);
$router->get('/listeAnimalEnVente',[$AchatController,'listeAnimalEnVente']);
$router->get('/achatAnimal',[$AchatController,'achatAnimal']);

$AdminEspeceController=new AdminEspeceController($url);
$router->get('/listeEspece',[$AdminEspeceController,'listeEspece']);
$router->post('/modifierEspece',[$AdminEspeceController,'modifierEspece']);

$AdminAnimalController=new AdminAnimalController($url);
$router->get('/listeAnimal',[$AdminAnimalController,'listeAnimal']);
$router->post('/ajoutAnimal',[$AdminAnimalController,'ajoutAnimal']);





