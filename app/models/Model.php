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
    
}
