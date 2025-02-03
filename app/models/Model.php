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

        $stmt->execute([$nom, $mdp]);
        $result = $stmt->fetch();

        if ($stmt->rowcount() > 0) {
            return $result['id'];
        } else {
            return 0;
        }
    }
}
