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
        $bool = $this->estVendable($idAnimal);
        if ($bool == true) {
            return $row["poids"] * $row["prixVenteKg"];
        } else {
            return 0;
        }
    }


    public function tableauDeBord($IdEleveur)
    {
        $sql = "SELECT * FROM V_AnimalEspece WHERE idEleveur = ? ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$IdEleveur]);
        $data = $stmt->fetchAll();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]["prixDeVente"] = $this->prixVente($data[$i]["id"]);
        }
        return $data;
    }
    public function fermeFiltre($idEleveur, $date, $poidsMin, $poidsMax, $prixMin, $prixMax, $etat, $espece)
    {
        $query = "SELECT 
        vae.animal_id,
        vae.image,
        vae.poids,
        vae.espece_id,
        vae.espece_nom,
        vae.poidsMax,
        vae.poidsMinVente,
        vae.nbJourFaim,
        vae.prixVenteKg,
        vae.pertePoidsJour,
        CASE 
            WHEN DATEDIFF(?, al.date) > vae.nbJourFaim THEN 'false'
            ELSE 'true'
        END as etat,
        CASE 
            WHEN vae.poids >= vae.poidsMinVente AND (DATEDIFF(?, al.date) <= vae.nbJourFaim) THEN vae.poids * vae.prixVenteKg
            ELSE 0
        END as prixDeVente
    FROM 
        V_AnimalEspece vae
    JOIN 
        (SELECT MAX(date) as date, idAnimal 
         FROM alimenter_elevage 
         WHERE idAnimal IN (SELECT animal_id FROM V_AnimalEspece WHERE idEleveur = ?) 
         GROUP BY idAnimal) al 
    ON vae.animal_id = al.idAnimal
    WHERE vae.idEleveur = ?
    ";
        $data = [$date, $date, $idEleveur, $idEleveur];
        if ($poidsMin !== null) {
            $query .= " AND vae.poids >= ?";
            $data[] = $poidsMin;
        }
        if ($poidsMax !== null) {
            $query .= " AND vae.poids <= ?";
            $data[] = $poidsMax;
        }
        if ($prixMin !== null) {
            $query .= " AND (CASE 
            WHEN vae.poids >= vae.poidsMinVente AND (DATEDIFF(?, al.date) <= vae.nbJourFaim) THEN vae.poids * vae.prixVenteKg
            ELSE 0
            END) >= ?";
            $data[] = $date;
            $data[] = $prixMin;
        }
        if ($prixMax !== null) {
            $query .= " AND (CASE 
            WHEN vae.poids >= vae.poidsMinVente AND (DATEDIFF(?, al.date) <= vae.nbJourFaim) THEN vae.poids * vae.prixVenteKg
            ELSE 0
            END) <= ?";
            $data[] = $date;
            $data[] = $prixMax;
        }
        if ($etat !== null) {
            $query .= " AND (CASE 
            WHEN DATEDIFF(?, al.date) > vae.nbJourFaim THEN 'false'
            ELSE 'true'
            END) = ?";
            $data[] = $date;
            $data[] = $etat;
        }
        if ($espece !== null) {
            $query .= " AND vae.espece_id = ?";
            $data[] = $espece;
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute($data);
        return $stmt->fetchAll();
    }

    public function listeEspeces()
    {
        $query = "select * from espece_elevage";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll();
    }
}
