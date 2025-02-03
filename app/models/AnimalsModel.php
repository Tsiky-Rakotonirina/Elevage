<?php

namespace app\models;

use Flight;

class AnimalsModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function nourrir($IdAnimal, $nbPortion, $date) {}
}
