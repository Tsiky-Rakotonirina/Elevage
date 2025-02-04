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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {
        $data = ['page' => '', 'url' => $this->url];
        Flight::render('index', $data);
    }
    public function nourirView()
    {

        $Alimentations = Flight::AnimalsModel()->listAlimentation($_SESSION['id']);
        $Animals = Flight::AnimalsModel()->listAnimal($_SESSION['id']);
        $data = ['page' => 'alimenter', 'url' => $this->url, 'animals' => $Animals, 'alimentations' => $Alimentations];
        Flight::render('template-front', $data);
    }
    public function nourrirAnimal()
    {
        $IdAnimal = Flight::request()->data->IdAnimal;
        $nbPortion = Flight::request()->data->nbPortion;
        $date = Flight::request()->data->date;
        $idAlimentation = Flight::request()->data->idAlimentation;

        $result = Flight::AnimalsModel()->nourrir($IdAnimal, $nbPortion, $date, $idAlimentation);
        $Alimentations = Flight::AnimalsModel()->listAlimentation($_SESSION['id']);
        $Animals = Flight::AnimalsModel()->listAnimal($_SESSION['id']);
        if ($result) {
            $data = ['page' => 'alimenter', 'url' => $this->url, 'animals' => $Animals, 'alimentations' => $Alimentations];
            // Flight::render('template-front', ['Success' => 'L\'animal a bien été nouri comme il faut. ', $data]);
            Flight::json(['Success' => 'L\'animal a bien été nouri comme il faut. ', $data]);
        } else {
            $data = ['page' => 'alimenter', 'url' => $this->url, 'animals' => $Animals, 'alimentations' => $Alimentations];
            // Flight::render('template-front', ['Error' => 'Vous n\'avez pas asser de ressources pour pouvoir nourir l\'animam .', $data]);
            Flight::json(['Error' => 'Vous n\'avez pas asser de ressources pour pouvoir nourir l\'animam .', $data]);
        }
    }
}
