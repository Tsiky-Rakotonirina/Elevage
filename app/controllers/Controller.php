<?php

namespace app\controllers;
use Flight;
use app\models\Model;

class Controller {
    protected $url;

	public function __construct($url) {
        $this->url=$url;
        session_start();
	}

    public function index() {
        $data = ['page'=>'','url'=>$this->url];
        Flight::render('index',$data);
    }

    public function connexionEleveur() {
		$id=Flight::Model()->connexionEleveur($_POST['nom'],$_POST['motDePasse']);
        if($id!=0) {
            $_SESSION['id']=$id;
            $data = ['page'=>'tableau-de-bord','url'=>$this->url];
            Flight::render('template-front',$data);
        } else {
            $data = ['erreur' => 'Informations incorrectes'];
            Flight::render('index',$data);
        }
    }

    public function reinitialiser() {
		Flight::Model()->reinitialiser($_POST['dateReinitialiser']);
        $data = ['page'=>'tableau-de-bord','url'=>$this->url];
        Flight::render('template-front',$data);
    }

    public function menuAdmin() {
        $caroussel=Flight::Model()->caroussel();
        $data = ['page'=>'menu','url'=>$this->url,'caroussel'=>$caroussel];
        Flight::render('template-back',$data);
    }

    public function connexionAdmin() {
		$id=Flight::Model()->connexionAdmin($_POST['nom'],$_POST['motDePasse']);
        if($id!=0) {
            $this->menu();
        } else {
            $data = ['page'=>'','url'=>$this->url];
            Flight::render('index',$data);
        }
    }

    

}