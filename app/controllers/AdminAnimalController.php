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

    public function ajoutAnimal($idEspece,$poids) {
        Flight::AdminAnimalModel()->ajoutAnimal($idEspece,$poids);
        $this->listeAnimal();
    }
    
}