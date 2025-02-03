<?php

namespace app\models;

use Flight;

class Model
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function connexionEleveur($nom, $mdp)
    {
        $sql = "SELECT * FROM eleveur_elevage WHERE nom = ? AND MotDePasse = ? ";
        $stmt = $this->db->prepare($sql);
        $data=array($nom,$mdp);
        $stmt->execute($data);
        $result = $stmt->fetch();
        if ($stmt->rowCount() > 0) {
            return $result['id'];
        } else {
            return 0;
        }
    }
    
    public function reinitialiser($date) {
        $sql = "DELETE FROM mouvementSolde_elevage where date>?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date]);

        $sql = "DELETE FROM alimenter_elevage where date>?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date]);

        $sql = "DELETE FROM achatAlimentation_elevage where date>?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$date]);

        $sql = "DELETE FROM transactionAnimal_elevage where date>?";
        $stmt = $this->db->prepare($sql);+
        $stmt->execute([$date]);

    }
}
