<?php

namespace app\models;

use Flight;

class SoldeModel
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
 
    public function solde($idEleveur) {
        $query = "SELECT sum(montant*effet) solde FROM V_MouvementRubrique WHERE idEleveur=? GROUP BY idEleveur";
        $stmt = $this->db->prepare($query);
        $data = array($idEleveur);
        $stmt->execute($data);
        $result = $stmt->fetch();
        return $result ? $result['solde'] : 0;
    }
    
    public function listeAlimentations() {
        $query = "select * from alimentation_elevage";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $data= $stmt->fetchAll(); 
        return $data;
    }

    public function listeMouvements($idEleveur) {
        $query = "SELECT * FROM V_MouvementRubrique WHERE idEleveur=? ORDER BY date DESC LIMIT 10";
        $stmt = $this->db->prepare($query);
        $data=array($idEleveur);
        $stmt->execute($data);
        return $stmt->fetchAll();
    }

    function getRubrique($nom) {
        $query = "SELECT id FROM rubrique_elevage WHERE nom LIKE ? ";
        $stmt = $this->db->prepare($query);
        $data=array($nom);
        $stmt->execute($data);
        $result = $stmt->fetch();
        return $result["id"];
    }

    public function depot($idEleveur,$montant) {
        $idRubrique=$this->getRubrique('Depot');
        $query = "INSERT INTO mouvementSolde_elevage (idEleveur,montant,idRubrique,date) VALUES (?,?,?,now())";
        $stmt = $this->db->prepare($query);
        $data=array($idEleveur,$montant,$idRubrique);
        $stmt->execute($data);
    }

    function getPrixAlimentation($id) {
        $query = "SELECT prix FROM alimentation_elevage WHERE id=? ";
        $stmt = $this->db->prepare($query);
        $data=array($id);
        $stmt->execute($data);
        $result = $stmt->fetch();
        return $result["prix"];
    }

    private function updateStockAlimentation($idEleveur, $idAlimentation, $nbPortion) {
        $query = "SELECT id FROM stockAlimentation_elevage WHERE idEleveur=? AND idAlimentation=?";
        $stmt = $this->db->prepare($query);
        $data = array($idEleveur, $idAlimentation);
        $stmt->execute($data);
        $result = $stmt->fetch();

        if ($result) {
            $query = "UPDATE stockAlimentation_elevage SET nbPortion = nbPortion + ? WHERE idEleveur = ? AND idAlimentation = ?";
            $stmt = $this->db->prepare($query);
            $data = array($nbPortion, $idEleveur, $idAlimentation);
        } else {
            $query = "INSERT INTO stockAlimentation_elevage (idEleveur, idAlimentation, nbPortion) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $data = array($idEleveur, $idAlimentation, $nbPortion);
        }
        $stmt->execute($data);
    }

    public function achatAlimentation($idEleveur,$nbPortion,$idAlimentation) {
        $montant=0;
        $montant=$this->getPrixAlimentation($idAlimentation)*$nbPortion;
        if($this->solde($idEleveur)<$montant) {
            return $montant-$this->solde($idEleveur);
        }
        
        $idRubrique=$this->getRubrique('Achat alimentation');
        $query = "INSERT INTO mouvementSolde_elevage (idEleveur,montant,idRubrique,date) VALUES (?,?,?,now())";
        $stmt = $this->db->prepare($query);
        $data=array($idEleveur,$montant,$idRubrique);
        $stmt->execute($data);

        $this->updateStockAlimentation($idEleveur, $idAlimentation, $nbPortion);

        return true;
    }

}
