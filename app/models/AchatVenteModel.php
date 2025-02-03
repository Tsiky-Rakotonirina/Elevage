<?php

namespace app\models;

use Flight;

class AchatVenteModel
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    function getRubrique($nom) {
        $query = "SELECT id FROM rubrique_elevage WHERE nom LIKE ? ";
        $stmt = $this->db->prepare($query);
        $data=array($nom);
        $stmt->execute($data);
        $result = $stmt->fetch();
        return $result["id"];
    }

    public function venteAnimal($idEleveur, $idAnimal, $prixDeVente) {
        $idRubrique = $this->getRubrique('Vente Animal');
        $stmt = $this->db->prepare("INSERT INTO mouvementSolde_elevage (idEleveur, idRubrique, montant, date) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$idEleveur, $idRubrique, $prixDeVente]);

        $stmt = $this->db->prepare("UPDATE animal_elevage SET idEleveur = 0 WHERE id = ?");
        $stmt->execute([$idAnimal]);

        $stmt = $this->db->prepare("INSERT INTO transactionAnimal_elevage (idAnimal, prix, date, vendu) VALUES (?, ?, NOW(), false)");
        $stmt->execute([$idAnimal, $prixDeVente]);
    }

    public function achatAnimal($idEleveur, $idAnimal, $prixAchat,$solde) {
        if($solde>$prixAchat) {
            $idRubrique = $this->getRubrique('Achat Animal');
            $stmt = $this->db->prepare("INSERT INTO mouvementSolde_elevage (idEleveur, idRubrique, montant, date) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$idEleveur, $idRubrique, $prixAchat]);

            $stmt = $this->db->prepare("UPDATE animal_elevage SET idEleveur = ? WHERE id = ?");
            $stmt->execute([$idEleveur, $idAnimal]);

            $stmt = $this->db->prepare("SELECT id FROM transactionAnimal_elevage WHERE idAnimal = ? AND vendu = false ORDER BY date DESC LIMIT 1");
            $stmt->execute([$idAnimal]);
            $transaction = $stmt->fetch();
            $transactionId = $transaction['id'];

            $stmt = $this->db->prepare("UPDATE transactionAnimal_elevage SET vendu = true WHERE id = ?");
            $stmt->execute([$transactionId]);

            return true;
        } else {
            return false;
        }
        
    }

    public function listeAnimalEnVente() {
        $stmt = $this->db->prepare("SELECT * FROM V_TransactionAnimalDetails WHERE vendu = false");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
