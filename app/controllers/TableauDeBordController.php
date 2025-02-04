<?php

namespace app\controllers;

use Flight;
use app\models\TableauDeBordModel;

class TableauDeBordController
{
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function tableauDeBord()
    {
        $data = ['page' => 'tableau-de-bord', 'url' => $this->url];
        Flight::render('template-front', $data);
    }

    public function fermeFiltre()
    {
        if (!isset($_GET['dateMortMin']) || $_GET['dateMortMin'] == "") {
            $_GET['dateMortMin'] = null;
        }
        if (!isset($_GET['dateMortMax']) || $_GET['dateMortMax'] == "") {
            $_GET['dateMortMax'] = null;
        }
        if (!isset($_GET['autoVente']) || $_GET['autoVente'] == "") {
            $_GET['autoVente'] = null;
        }
        if (!isset($_GET['idEspece']) || $_GET['idEspece'] == "") {
            $_GET['idEspece'] = null;
        }
        $animaux = Flight::TableauDeBordModel()->fermeFiltre(
            $_SESSION['id'],
            $_GET['date'],
            $_GET['dateMortMin'],
            $_GET['dateMortMax'],
            $_GET['autoVente'],
            $_GET['idEspece']
        );

        $especes = Flight::TableauDeBordModel()->listeEspeces();
        $data = ['page' => 'ferme', 'url' => $this->url, 'date' => $_GET['date'], 'animaux' => $animaux, 'especes' => $especes];
        Flight::render('template-front', $data);
    }

}
