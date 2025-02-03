<?php
use app\controllers\ApiExampleController;
use app\controllers\Controller;
use app\controllers\TableauDeBordController;
use app\controllers\SoldeController;
use app\controllers\AchatVenteController;

use flight\Engine;
use flight\net\Router;

$url=Flight::get('flight.base_url');
$Controller=new Controller($url);
$router->get('/', [ $Controller, 'index']);
$router->post('/connexionEleveur', [ $Controller, 'connexionEleveur']);  
$router->post('/reinitialiser', [ $Controller, 'reinitialiser']);  

$TableauDeBordController=new TableauDeBordController($url);
$router->get('/tableauDeBord', [ $TableauDeBordController, 'tableauDeBord']);   
$router->get('/fermeFiltre', [ $TableauDeBordController, 'fermeFiltre']);   

$SoldeController=new SoldeController($url);
$router->get('/solde',[$SoldeController,'solde']);
$router->post('/depot',[$SoldeController,'depot']);
$router->post('/achatAlimentation',[$SoldeController,'achatAlimentation']);

$AchatVenteController=new AchatVenteController($url);
$router->get('/venteAnimal',[$AchatVenteController,'venteAnimal']);
$router->get('/listeAnimalEnVente',[$AchatVenteController,'listeAnimalEnVente']);
$router->get('/achatAnimal',[$AchatVenteController,'achatAnimal']);
