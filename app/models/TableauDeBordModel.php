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
    public function listAllAnimalsByIdEleveur($IdEleveur)
    {
        $sql = "SELECT * FROM animals WHERE idEleveur = :idEleveur";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idEleveur', $IdEleveur);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getEspeceByIdEspece($IdEspece)
    {
        $sql = "SELECT * FROM especes WHERE idEspece = :idEspece";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idEspece', $IdEspece);
        $stmt->execute();
        return $stmt->fetch();
    }
}
