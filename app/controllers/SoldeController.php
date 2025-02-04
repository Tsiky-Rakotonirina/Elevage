<?php

namespace app\controllers;

use Flight;
use app\models\SoldeModel;

class SoldeController
{
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function solde()
    {
        $solde = Flight::SoldeModel()->solde($_SESSION['id']);
        $alimentations = Flight::SoldeModel()->listeAlimentations();
        $mouvements = Flight::SoldeModel()->listeMouvements($_SESSION['id']);
        $data = ['page' => 'solde', 'url' => $this->url, 'solde' => $solde, 'alimentations' => $alimentations, 'mouvements' => $mouvements];
        Flight::render('template-front', $data);
    }

    public function depot()
    {
        Flight::SoldeModel()->depot($_SESSION['id'], $_POST['montant']);
        $this->solde();
    }

    public function achatAlimentation()
    {
        $achat = Flight::SoldeModel()->achatAlimentation($_SESSION['id'], $_POST['nbPortion'], $_POST['idAlimentation']);
        $solde = Flight::SoldeModel()->solde($_SESSION['id']);
        $alimentations = Flight::SoldeModel()->listeAlimentations();
        $mouvements = Flight::SoldeModel()->listeMouvements($_SESSION['id']);
        if ($achat == true) {
            $data = ['page' => 'solde', 'url' => $this->url, 'solde' => $solde, 'alimentations' => $alimentations, 'mouvements' => $mouvements, 'succes' => 'Achat effectue'];
            Flight::render('template-front', $data);
        } else {
            $data = ['page' => 'solde', 'url' => $this->url, 'solde' => $solde, 'alimentations' => $alimentations, 'mouvements' => $mouvements, 'erreur' => 'Solde insuffisant de ' . $achat . ' ar'];
            Flight::render('template-front', $data);
        }
    }
}
