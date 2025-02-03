<?php

namespace app\controllers;

use Flight;
use app\models\Model;

class AnimalsController
{
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function index()
    {
        $data = ['page' => '', 'url' => $this->url];
        Flight::render('index', $data);
    }
    public function nourirView()
    {

        $Alimentations = Flight::AnimalsModel()->listAnimal();
        $Animals = Flight::AnimalsModel()->listAnimal();
        $data = ['page' => 'template-front', 'url' => $this->url, 'animals' => $Animals, 'alimentations' => $Alimentations];
        Flight::render('animals/nourir', $data);
    }
    public function nourrirAnimal()
    {
        $IdAnimal = Flight::request()->data->IdAnimal;
        $nbPortion = Flight::request()->data->nbPortion;
        $date = Flight::request()->data->date;
        $idAlimentation = Flight::request()->data->idAlimentation;

        $result = Flight::AnimalsModel()->nourrirAnimal($IdAnimal, $nbPortion, $date, $idAlimentation);

        if ($result) {
            Flight::render('template-front', ['Success' => 'L\'animal a bien été nouri comme il faut. ']);
        } else {
            Flight::render('template-front', ['Error' => 'Vous n\'avez pas asser de ressources pour pouvoir nourir l\'animam .']);
        }
    }
}
