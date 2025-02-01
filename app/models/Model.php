<?php

namespace app\models;
use Flight;

class Model {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
}