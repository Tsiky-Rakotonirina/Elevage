<?php

namespace app\controllers;
use app\models\AdminEspeceModel;
use Flight;

class AdminEspeceController {

    protected $url;

    public function __construct($url) {
        $this->url=$url;
    }
    
    public function listeEspece() {
        $especes = Flight::AdminEspeceModel()->listeEspeces();
        $data = ['page' => 'espece', 'url' => $this->url, 'especes' => $especes];
        Flight::render('template-back', $data);
    }

    public function modifierEspece() {
        $id = $_POST['id'];
        if (isset($_POST['nom']) && $_POST['nom'] != null && $_POST['nom'] != "") {
            Flight::AdminEspeceModel()->modifierEspeceNom($id, $_POST['nom']);
        }
        if (isset($_POST['poidsMax']) && $_POST['poidsMax'] != null && $_POST['poidsMax'] != "") {
            Flight::AdminEspeceModel()->modifierEspecePoidsMax($id, $_POST['poidsMax']);
        }
        if (isset($_POST['poidsMinVente']) && $_POST['poidsMinVente'] != null && $_POST['poidsMinVente'] != "") {
            Flight::AdminEspeceModel()->modifierEspecePoidsMinVente($id, $_POST['poidsMinVente']);
        }
        if (isset($_POST['nbJourFaim']) && $_POST['nbJourFaim'] != null && $_POST['nbJourFaim'] != "") {
            Flight::AdminEspeceModel()->modifierEspeceNbJourFaim($id, $_POST['nbJourFaim']);
        }
        if (isset($_POST['prixVenteKg']) && $_POST['prixVenteKg'] != null && $_POST['prixVenteKg'] != "") {
            Flight::AdminEspeceModel()->modifierEspecePrixVenteKg($id, $_POST['prixVenteKg']);
        }
        if (isset($_POST['pertePoidsJour']) && $_POST['pertePoidsJour'] != null && $_POST['pertePoidsJour'] != "") {
            Flight::AdminEspeceModel()->modifierEspecePertePoidsJour($id, $_POST['pertePoidsJour']);
        }
        if(isset($_FILE["image"])){
            $tailleMax = 500000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['image']['name'], '.');
            if(in_array($extension, $extensions) && $taille>$tailleMax) {
                $nom=time();
                $repertoire ='/public/assets/images/';
                $cheminBase =  $repertoire . $nom . $extension;
                $cheminDeplacement = $_SERVER['DOCUMENT_ROOT'] . $this->url . $cheminBase;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $cheminDeplacement)) {
                    Flight::AdminEspeceModel()->modifierEspeceImage($id, $cheminBase);
                }
            }
        }
        $this->listeEspece();
    }
    
}