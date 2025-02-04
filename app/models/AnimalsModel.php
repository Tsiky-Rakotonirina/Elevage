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
    public function nourrir($IdAnimal, $nbPortion, $date, $idAlimentation)
    {
        $sql_eleveur = "select idEleveur from animal_elevage where id = ?";
        $stmtEleveur = $this->db->prepare($sql_eleveur);
        $stmtEleveur->execute([$IdAnimal]);
        $idEleveur = $stmtEleveur->fetch()['idEleveur'];

        $sql_stock = "select nbPortion from stockAlimentation_elevage where idEleveur = ? and idAlimentation = ?  ";
        $stmtStock = $this->db->prepare($sql_stock);
        $stmtStock->execute([$idEleveur, $idAlimentation]);
        $stock = $stmtStock->fetch()['nbPortion'];

        if ($stock > $nbPortion) {
            $newStock = $stock - $nbPortion;

            $sql_Detail = "select id from detailsAlimentation_elevage  where idAlimentation = ?";
            $stmtDetail = $this->db->prepare($sql_Detail);
            $stmtDetail->execute([$idAlimentation]);
            $idDetailsAlimentation = $stmtDetail->fetch()['id'];

            $sql = "insert into alimenter_elevage (idAnimal, nbPortion, date, idDetailsAlimentation ) values(?,?,?,?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$IdAnimal, $nbPortion, $date, $idDetailsAlimentation]);

            // $sqlDetailAlimentaion = "select * from detailsAlimentation_elevage where id = ?";
            // $stmtDetailAlimentaion = $this->db->prepare($sqlDetailAlimentaion);
            // $stmtDetailAlimentaion->execute([$idDetailsAlimentation]);
            // $gain = $stmtDetailAlimentaion->fetch()['gain'];

            // $sql_poid = "select poid from animal_elevage where idAnimal = ? ";
            // $stmt_poid = $this->db->prepare($sql_poid);
            // $stmt_poid->execute([$IdAnimal]);
            // $poid_animal = $stmt_poid->fetch()['poid'];

            // $sql_poid_max = "select poidsMax from espece_elevage where idAnimal = ?";
            // $stmt_poid_max = $this->db->prepare($sql_poid_max);
            // $stmt_poid_max->execute([$IdAnimal]);
            // $poids_max = $stmt_poid_max->fetch()['poidsMax'];

            // if (($poid_animal + $poid_animal * $gain) > $poids_max && $poid_animal == $poids_max) {
            //     $poid_animal = $poids_max;
            // } else if ($poid_animal < $poids_max) {
            //     $poid_animal += $poid_animal * $gain;
            // }

            // $sql2 = "update animal_elevage set poids = ? where idAnimal = ? ";
            // $stmt2 = $this->db->prepare($sql2);
            // $stmt2->execute([$poid_animal, $IdAnimal]);

            $sql_update_stock = "update stockAlimentation_elevage set nbPortion = ? where idEleveur = ? and  idAlimentation = ? ";
            $stmt_update_stock = $this->db->prepare($sql_update_stock);
            $stmt_update_stock->execute([$newStock, $idEleveur, $idAlimentation]);
            return true;
        } else {
            return false;
        }
    }
    public function getPoidActuel($IdAnimal, $date)
    {
        $sql = "select poids from animal_elevage where id=? ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$IdAnimal]);
        $poid = $stmt->fetch()['poids'];
        $sql_alimenter_detail = "SELECT   ae.id AS alimenter_id, ae.idAnimal, ae.nbPortion, ae.date, ae.idDetailsAlimentation, da.id as detail_id , da.idEspece , da.idAlimentation , da.gain FROM alimenter_elevage ae JOIN detailsAlimentation_elevage da ON ae.idDetailsAlimentation = da.id WHERE ae.date < ? and idAnimal = ?";

        $stmt_gain = $this->db->prepare($sql_alimenter_detail);
        $stmt_gain->execute([$date, $IdAnimal]);
        $data = $stmt_gain->fetchAll();
        $sql_poid_max = "select poidsMax from espece_elevage where id = ?";
        $stmt_poid_max = $this->db->prepare($sql_poid_max);
        $stmt_poid_max->execute([$IdAnimal]);
        $poids_max = $stmt_poid_max->fetch()['poidsMax'];
        foreach ($data as $row) {
            $nbPortion = $row['nbPortion'];
            $gain = $row['gain'];
            echo $row['gain'];
            if (($poid + $poid * $gain / 100 * $nbPortion) >= $poids_max || ($poid == $poids_max)) {
                $poid = $poids_max;
            } else {
                $poid += $poid * $gain / 100 * $nbPortion;
            }
        }
        $sql_animal_espece = "select e.pertePoidsJour from animal_elevage as a  join espece_elevage as e on a.idEspece = e.id where a.id = ?";
        $stmt_animal_espece = $this->db->prepare($sql_animal_espece);
        $stmt_animal_espece->execute([$IdAnimal]);
        $pertePoidsJour = $stmt_animal_espece->fetch()['pertePoidsJour'];

        $sql_nb_jour_manger = "SELECT count(id) as isa FROM alimenter_elevage WHERE idAnimal = ? GROUP BY date ";
        $stmt_nb_jour_manger = $this->db->prepare($sql_nb_jour_manger);
        $stmt_nb_jour_manger->execute([$IdAnimal]);
        $nb_jour_manger = $stmt_nb_jour_manger->fetch()['isa'];

        $sql_nb_delta_jour = "select dateDiff(?,'2025-02-03') as nb_jour from espece_elevage as nb_jour";
        $stmt_nb_delta_jour = $this->db->prepare($sql_nb_delta_jour);
        $stmt_nb_delta_jour->execute([$date]);
        $nb_delta_jour = $stmt_nb_delta_jour->fetch()['nb_jour'];

        $nb_jour_regime = $nb_delta_jour - $nb_jour_manger;
        $poid = $poid -  $pertePoidsJour * $nb_jour_regime;
        if ($poid < 0) {
            $poid = 0;
        }
        return $poid;
    }
    public function listAnimal($idEleveur)
    {
        $sql = "SELECT id FROM animal_elevage WHERE idEleveur =?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idEleveur]);
        return $stmt->fetchAll();
    }
    public function listAlimentation($idEleveur)
    {
        $sql = "SELECT ae.nom , ae.id
                FROM stockAlimentation_elevage sae
                JOIN alimentation_elevage ae ON sae.idAlimentation = ae.id
                WHERE sae.idEleveur = ? AND sae.nbPortion > 0
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idEleveur]);
        return $stmt->fetchAll();
    }
}
