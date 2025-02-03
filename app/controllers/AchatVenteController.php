<?php

namespace app\controllers;
use Flight;
use app\models\AchatVenteModel;
use app\models\TableauDeBordModel;
use app\models\SoldeModel;

class AchatVenteController {
    protected $url;

    public function __construct($url) {
        $this->url = $url;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function venteAnimal() {
        Flight::AchatVenteModel()->venteAnimal($_SESSION['id'], $_GET['idAnimal'], $_GET['prixDeVente']);
        $animaux = Flight::TableauDeBordModel()->fermeFiltre(
            $_SESSION['id'],
            $_GET['date'],
            null, null, null, null, null, null
        );
        $especes = Flight::TableauDeBordModel()->listeEspeces();
        $data = ['page' => 'ferme', 'url' => $this->url, 'date' => $_GET['date'], 'animaux' => $animaux, 'especes' => $especes];
        Flight::render('template-front', $data);
    }

    public function listeAnimalEnVente() {
        $animaux = Flight::AchatVenteModel()->listeAnimalEnVente();
        $data = ['page' => 'achat-vente', 'url' => $this->url, 'animaux' => $animaux];
        Flight::render('template-front', $data);
    }

    public function achatAnimal() {
		$solde=Flight::SoldeModel()->solde($_SESSION['id']);
        $achat=Flight::AchatVenteModel()->achatAnimal($_SESSION['id'], $_GET['idAnimal'], $_GET['prixAchat'],$solde);
        if($achat==true) {
            $this->listeAnimalEnVente();
        } else {
            $animaux = Flight::AchatVenteModel()->listeAnimalEnVente();
            $data = ['page' => 'achat-vente', 'url' => $this->url, 'animaux' => $animaux,'erreur'=>'Solde insuffisant'];
            Flight::render('template-front', $data);
        }
    } 
}