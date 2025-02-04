<?php

namespace app\models;

use Flight;

class AchatModel
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listeAnimalEnVente() {
        $stmt = $this->db->prepare("SELECT * FROM V_TransactionAnimalDetails WHERE vendu = false");
        $stmt->execute();
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

    public function achatAnimal($idTransaction,$idEleveur, $idAnimal, $prixAchat, $solde,$dateVente,$autoVente) {
        if($solde>$prixAchat) {
            $idRubrique = $this->getRubrique('Achat Animal');
            $stmt = $this->db->prepare("INSERT INTO mouvementSolde_elevage (idEleveur, idRubrique, montant, date) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$idEleveur, $idRubrique, $prixAchat]);

            $stmt = $this->db->prepare("UPDATE animal_elevage SET idEleveur = ? WHERE id = ?");
            $stmt->execute([$idEleveur, $idAnimal]);
            $stmt = $this->db->prepare("UPDATE animal_elevage SET autoVente = ? WHERE id = ?");
            $stmt->execute([$autoVente, $idAnimal]);
            if($dateVente!=null && $dateVente!="")
            $stmt = $this->db->prepare("UPDATE animal_elevage SET dateVente = ? WHERE id = ?");
            $stmt->execute([$dateVente, $idAnimal]);
            

            $stmt = $this->db->prepare("UPDATE transactionAnimal_elevage SET vendu = true WHERE id = ?");
            $stmt->execute([$idTransaction]);

            return true;
        } else {
            return false;
        }
    }
    
}
