<?php

namespace app\controllers;
use app\models\AdminEspeceModel;
use app\models\AdminAnimalModel;
use Flight;

class AdminAnimalController {

    protected $url;

    public function __construct($url) {
        $this->url=$url;
    }
    
    public function listeAnimal() {
        $especes = Flight::AdminEspeceModel()->listeEspeces();
        $animaux = Flight::AdminAnimalModel()->listeAnimal();
        $data = ['page' => 'animal', 'url' => $this->url, 'especes' => $especes,'animaux'=>$animaux];
        Flight::render('template-back', $data);
    }

    public function ajoutAnimal() {
        Flight::AdminAnimalModel()->ajoutAnimal($_POST["idEspece"],$_POST["poids"],$_POST["dateMort"]);
        $this->listeAnimal();
    }
    
}