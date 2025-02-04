<?php

namespace app\models;

use Flight;

class AdminAnimalModel
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listeAnimal() {
        $query = "SELECT * FROM V_AnimalEspece ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getPrixVenteKg($id) {
        $query = "select prixVenteKg from espece_elevage where id=?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $data= $stmt->fetch(); 
        return $data ["prixVenteKg"];
    }

    function getAnimalId() {
        $query = "select max(id) id from animal_elevage";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $data= $stmt->fetch(); 
        return $data ["id"];
    }

    public function ajoutAnimal($idEspece,$poids,$dateMort) {
        $stmt = $this->db->prepare("INSERT INTO animal_elevage(idEleveur,idEspece,poidsInitial,dateMort) VALUES (?,?,?,?)");
        $stmt->execute([9999,$idEspece,$poids,$dateMort]);
        $stmt = $this->db->prepare("INSERT INTO transactionAnimal_elevage(idAnimal,prix,date,vendu) VALUES (?,?,now(),false)");
        $idAnimal=$this->getAnimalId();
        $prix=$this->getPrixVenteKg($idEspece);
        $stmt->execute([$idAnimal,$prix]);
    }
    
}
