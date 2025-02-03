<?php

namespace app\models;

use Flight;

class TableauDeBordModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function tableauDeBord($IdEleveur)
    {
        $sql = "SELECT * FROM V_AnimalEspece WHERE idEleveur = ? ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$IdEleveur]);
        $data=$stmt->fetchAll();
        for($i=0;$i<count($data);$i++) {
            $data[$i]["prixDeVente"]=prixVente($data[$i]["id"]);
        }
        return $data;
    }


    public function estVendable($idAnimal) // Correction ici
    {
        $sql = "SELECT poids,poidsMinVente FROM V_AnimalEspece WHERE = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idAnimal]);
        $row = $stmt->fetch();
        if ($row['poids'] >= $row['poidsMinVente']) {
            return true;
        } else {
            return false;
        }
    }

    public function prixVente($idAnimal)
    {
        $sql = "SELECT * FROM V_AnimalEspece WHERE animal_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idAnimal]);
        $row = $stmt->fetch();
        $bool=estVendable($idAnimal);
        if ($bool == true) {
            return $row["poids"]*$row["prixVenteKg"];
        } else {
            return 0;
        }
    }



    
}
