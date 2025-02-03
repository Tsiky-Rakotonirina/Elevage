<?php

namespace app\controllers;
use Flight;
use app\models\TableauDeBordModel;

class TableauDeBordController {
    protected $url;

	public function __construct($url) {
        $this->url=$url;
	}

    public function tableauDeBord() {
		// $tableaux=Flight::Model()->tableauDeBord($_SESSION["id"],$_POST["date"]);
        // $prix=Flight::Model()->prixVente($_SESSION["id"],$_POST["date"]);
        
        $data = ['page'=>'ferme','url'=>$this->url];
        Flight::render('template-front',$data);
    }

}