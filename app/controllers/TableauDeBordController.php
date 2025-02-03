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
		$tableaux=Flight::Model()->tableauDeBord($_SESSION["id"],$_POST["date"]);
        $prix=Flight::Model()->prixVente($_SESSION["id"],$_POST["date"]);
        
        $data = ['page'=>'ferme','url'=>$this->url,'tableaux'=>$tableaux];
        Flight::render('template-back',$data);
    }

    public function fermeFiltre() {
        if(!isset($_GET['poidsMin']) || $_GET['poidsMin'] == "") {
            $_GET['poidsMin']=null;
        }
        if(!isset($_GET['poidsMax']) || $_GET['poidsMax'] == "") {
            $_GET['poidsMax']=null;
        }
        if(!isset($_GET['prixMin']) || $_GET['prixMin'] == "") {
            $_GET['prixMin']=null;
        }
        if(!isset($_GET['prixMax']) || $_GET['prixMax'] == "") {
            $_GET['prixMax']=null;
        }
        if(!isset($_GET['etat']) || $_GET['etat'] == "") {
            $_GET['etat']=null;
        }
        if(!isset($_GET['espece']) || $_GET['espece'] == "") {
            $_GET['espece']=null;
        }
        $tableaux=Flight::Model()->tableauDeBord($_GET['poidsMin'],$_GET['poidsMax'],$_GET['prixMin'],$_GET['prixMax'],$_GET['etat'],$_GET['espece']);
        $prix=Flight::Model()->prixVente($_SESSION["id"],$_POST["date"]);
        
        $data = ['page'=>'ferme','url'=>$this->url,'habitations'=>$habitations];
        Flight::render('template-back',$data);
    }

}