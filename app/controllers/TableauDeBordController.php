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
        if (!isset($_GET['poidsMin']) || $_GET['poidsMin'] == "") {
            $_GET['poidsMin'] = null;
        }
        if (!isset($_GET['poidsMax']) || $_GET['poidsMax'] == "") {
            $_GET['poidsMax'] = null;
        }
        if (!isset($_GET['prixMin']) || $_GET['prixMin'] == "") {
            $_GET['prixMin'] = null;
        }
        if (!isset($_GET['prixMax']) || $_GET['prixMax'] == "") {
            $_GET['prixMax'] = null;
        }
        if (!isset($_GET['etat']) || $_GET['etat'] == "") {
            $_GET['etat'] = null;
        }
        if (!isset($_GET['espece']) || $_GET['espece'] == "") {
            $_GET['espece'] = null;
        }
        $animaux = Flight::TableauDeBordModel()->fermeFiltre(
            $_SESSION['id'],
            $_GET['date'],
            $_GET['poidsMin'],
            $_GET['poidsMax'],
            $_GET['prixMin'],
            $_GET['prixMax'],
            $_GET['etat'],
            $_GET['espece']
        );
        foreach ($animaux as &$animal) {
            $animal['poids'] = Flight::AnimalsModel()->getPoidActuel($animal['animal_id'], $_GET['date']);
        }


        $especes = Flight::TableauDeBordModel()->listeEspeces();
        $data = ['page' => 'ferme', 'url' => $this->url, 'date' => $_GET['date'], 'animaux' => $animaux, 'especes' => $especes];
        Flight::render('template-front', $data);
    }
}
