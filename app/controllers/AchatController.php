<?php

namespace app\controllers;
use Flight;
use app\models\AchatModel;
use app\models\TableauDeBordModel;
use app\models\SoldeModel;

class AchatController 
{
    protected $url;

    public function __construct($url) {
        $this->url = $url;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function listeAnimalEnVente() {
        $animaux = Flight::AchatModel()->listeAnimalEnVente();
        $data = ['page' => 'achat', 'url' => $this->url, 'animaux' => $animaux];
        Flight::render('template-front', $data);
    }

    public function achatAnimal() {
		$solde=Flight::SoldeModel()->solde($_SESSION['id']);
        $achat=Flight::AchatModel()->achatAnimal($_GET["idTransaction"],$_SESSION['id'], $_GET['idAnimal'], $_GET['prixAchat'],$solde,$_GET['dateVente'],$_GET['autoVente']);
        if($achat==true) {
            $this->listeAnimalEnVente();
        } else {
            $animaux = Flight::AchatModel()->listeAnimalEnVente();
            $data = ['page' => 'achat', 'url' => $this->url, 'animaux' => $animaux,'erreur'=>'Solde insuffisant'];
            Flight::render('template-front', $data);
        }
    } 
    
}