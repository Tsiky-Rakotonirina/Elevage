<?php

namespace app\controllers;
use Flight;
use app\models\Model;

class Controller {
    protected $url;

	public function __construct($url) {
        $this->url=$url;
	}

    public function index() {
        $data = ['page'=>'','url'=>$this->url];
        Flight::render('index',$data);
    }

    public function connexionEleveur() {
		// $id=Flight::Model()->connexionEleveur($_POST['nom'],$_POST['motDePasse']);
        // if($id!=0) {
        //     $_SESSION['id']=$id;
        //     $data = ['page'=>'tableau-de-bord','url'=>$this->url];
        //     Flight::render('template-back',$data);
        // } else {
        //     $data = ['erreur' => 'Informations incorrectes'];
        //     Flight::render('index',$data);
        // }
        $data = ['page'=>'tableau-de-bord','url'=>$this->url];
        Flight::render('template-back',$data);

    }

}