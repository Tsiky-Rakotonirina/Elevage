<?php

namespace app\models;

use Flight;

class tableauDeBordModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllAnimalsByIdeleveur($IdEleveur)
    {
        $sql = "SELECT * FROM V_AnimalEspece WHERE idEleveur = ? ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$IdEleveur]);
        return $stmt->fetchAll();
    }


    public function estVendable($idAnimal) // Correction ici
    {
        $sql = "SELECT poids, etat, poidsMinVente FROM V_AnimalEspece WHERE animal_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idAnimal]);
        $row = $stmt->fetch();
        if ($row['etat'] == true && $row['poids'] >= $row['poidsMinVente']) {
            return true;
        } else {
            return false;
        }
    }

    public function prixVente($idAnimal, $bool)
    {
        $sql = "SELECT * FROM V_AnimalEspece WHERE animal_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idAnimal]);
        $row = $stmt->fetch();

        if ($bool == true) {
        } else {
            return 0;
        }
    }
}
