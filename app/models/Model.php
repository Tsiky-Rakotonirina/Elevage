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
        $stmt->bind_param("ss", $nom, $mdp);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result['id'];
        } else {
            return 0;
        }
    }
    
}
