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

    private function listeStock($IdEleveur) {
        $sql = "SELECT * FROM stockAlimentation_elevage WHERE idEleveur = ? ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$IdEleveur]);
        return $stmt->fetchAll();
    }

    private function listeDetailsAlimentation($IdEleveur) {
        $sql = "SELECT d.idAlimentation,s.nbPortion,d.gain,d.idEspece FROM detailsAlimentation_elevage d JOIN stockAlimentation_elevage s ON d.idAlimentation=s.idAlimentation WHERE s.idEleveur=? ORDER BY idAlimentation ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$IdEleveur]);
        return $stmt->fetchAll();
    }

    private function nbPortionJourTotale($data) {
        $total = 0;
        foreach ($data as $item) {
            if (isset($item['quotaJournalier'])) {
                $total += $item['quotaJournalier'];
            }
        }
        return $total;
    }

    private function updateStock($stocks,$nbPortionJourTotale)
    {
        $totalPortions = 0;
        foreach ($stocks as $stock) {
            $totalPortions += $stock['nbPortion'];
        }
        if ($totalPortions >= $nbPortionJourTotale) {
            return -1;
        } else {
            return $totalPortions;
        }
    }

    private function nombreJour($date)
    {
        $targetDate = new \DateTime('2025-02-03');
        $currentDate = new \DateTime($date);
        $interval = $currentDate->diff($targetDate);
        return $interval->days;
    }

    private function gain($details, $idEspece, $quotaJournalier)
    {
        foreach ($details as &$detail) {
            if ($detail['idEspece'] == $idEspece && $detail['nbPortion'] > 0) {
                $idAlimenation=$detail['idAlimentation'];
                foreach($details as &$detail1) {
                    $detail1['nbPortion']=$detail1['nbPortion']-$quotaJournalier;
                }
                return $detail['gain'];
            }
        }
        return $gainTotal;
    }

    public function fermeFiltre($idEleveur, $date, $dateMortMin, $dateMortMax, $autoVente, $idEspece) {
        $query = "SELECT *
                FROM 
                    V_AnimalEspece
                WHERE idEleveur = ? AND 1=1 
                ";
        $data = [$idEleveur];
        if ($idEspece !== null) {
            $query .= " AND espece_id = ?";
            $data[] = $idEspece;
        }
        if ($autoVente !== null) {
            $query .= " AND autoVente = ?";
            $data[] = $autoVente;
        }
        if ($dateMortMin !== null) {
            $query .= " AND dateMort>= ?";
            $data[] = $dateMortMin;
        }
        if ($dateMortMax !== null) {
            $query .= " AND dateMort<= ?";
            $data[] = $dateMortMax;
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        for($j=0;$j<count($result);$j++) {
            if($result[$j]["dateMort"]==$date) {
                $result[$j]["etat"]=false;
            } else {
                $result[$j]["etat"]=true;
            }
            if(($result[$j]["autoVente"] && $result[$j]["poidsInitial"]>=$result[$j]["poidsMinVente"]) || (!$result[$j]["autoVente"] && $result[$j]["dateVente"]<=$date)) {
                $result[$j]["prixDeVente"]=$result[$j]["poidsInitial"]*$result[$j]["prixVenteKg"];
            } else {
                $result[$j]["prixDeVente"]=0;
            }
        }
        $stocks = $this->listeStock($idEleveur);
        $details = $this->listeDetailsAlimentation($idEleveur);
        $nombreJour = $this->nombreJour($date);
        $nbPortionJourTotale = $this->nbPortionJourTotale($data);
        for ($i = 0; $i < $nombreJour; $i++) {
            $stock = $this->updateStock($stocks, $nbPortionJourTotale);
            if ($stock == -1) {
                $nbPortionJourTotaleProvisoire = $nbPortionJourTotale;
                foreach ($stocks as &$stockItem) {
                    if ($stockItem['nbPortion'] >= $nbPortionJourTotaleProvisoire) {
                        $stockItem['nbPortion'] -= $nbPortionJourTotaleProvisoire;
                        $nbPortionJourTotaleProvisoire = 0;
                        break;
                    } else {
                        $nbPortionJourTotaleProvisoire -= $stockItem['nbPortion'];
                        $stockItem['nbPortion'] = 0;
                        if($nbPortionJourTotaleProvisoire==0) {
                            break;
                        }
                    }
                }
                for($j=0;$j<count($result);$j++) {
                    $gain=$this->gain($details,$result[$j]["espece_id"],$result[$j]["quotaJournalier"]);
                    if($result[$j]["poidsInitial"]<$result[$j]["poidsMax"]) {
                        $nouveauPoids=$result[$j]["poidsInitial"]+($result[$j]["poidsInitial"]*$gain/100);
                        if($nouveauPoids<$result[$j]["poidsMax"]) {
                            $result[$j]["poidsInitial"]=$nouveauPoids;
                        } else {
                            $result[$j]["poidsInitial"]=$result[$j]["poidsMax"];
                        }
                    }
                    if($result[$j]["dateMort"]==$date) {
                        $result[$j]["etat"]=false;
                    } else {
                        $result[$j]["etat"]=true;
                    }
                    if(($result[$j]["autoVente"] && $result[$j]["poidsInitial"]>=$result[$j]["poidsMinVente"]) || (!$result[$j]["autoVente"] && $result[$j]["dateVente"]<=$date)) {
                        $result[$j]["prixDeVente"]=$result[$j]["poidsInitial"]*$result[$j]["prixVenteKg"];
                    } else {
                        $result[$j]["prixDeVente"]=0;
                    }
                }
            } else {
                $gain=0;
                for($j=0;$j<count($result);$j++) {
                    foreach ($details as &$detail) {
                        if ($detail['idEspece'] == $idEspece && $detail['nbPortion'] > 0) {
                            $idAlimenation=$detail['idAlimentation'];
                            foreach($details as &$detail1) {
                                $detail1['nbPortion']=$detail1['nbPortion']-$result[$j]["quotaJournalier"];
                            }
                            $gain=$detail['gain'];
                        }
                    }
                    if($gain==0) {
                        if($result[$j]["faim"]!=null || $result[$j]["faim"]!=0 || $result[$j]["faim"]!="") {
                            $result[$j]["faim"]++;
                        } else {
                            $result[$j]["faim"]=0;
                        }
                        $result[$j]["poidsInitial"]=$result[$j]["poidsInitial"]-($result[$j]["poidsInitial"]*$pertePoidsJour/100);
                        if($result[$j]["dateMort"]==$date || $result[$j]["faim"]>=$result[$j]["nbJourFaim"]) {
                            $result[$j]["etat"]=false;
                        } else {
                            $result[$j]["etat"]=true;
                        }
                        if(($result[$j]["autoVente"] && $result[$j]["poidsInitial"]>=$result[$j]["poidsMinVente"]) || (!$result[$j]["autoVente"] && $result[$j]["dateVente"]<=$date)) {
                            $result[$j]["prixDeVente"]=$result[$j]["poidsInitial"]*$result[$j]["prixVenteKg"];
                        } else {
                            $result[$j]["prixDeVente"]=0;
                        }
                        continue;
                    }
                    if($result[$j]["poidsInitial"]<$result[$j]["poidsMax"]) {
                        $nouveauPoids=$result[$j]["poidsInitial"]+($result[$j]["poidsInitial"]*$gain/100);
                        if($nouveauPoids<$result[$j]["poidsMax"]) {
                            $result[$j]["poidsInitial"]=$nouveauPoids;
                        } else {
                            $result[$j]["poidsInitial"]=$result[$j]["poidsMax"];
                        }
                    }
                    if($result[$j]["dateMort"]==$date) {
                        $result[$j]["etat"]=false;
                    } else {
                        $result[$j]["etat"]=true;
                    }
                    if(($result[$j]["autoVente"] && $result[$j]["poidsInitial"]>=$result[$j]["poidsMinVente"]) || (!$result[$j]["autoVente"] && $result[$j]["dateVente"]<=$date)) {
                        $result[$j]["prixDeVente"]=$result[$j]["poidsInitial"]*$result[$j]["prixVenteKg"];
                    } else {
                        $result[$j]["prixDeVente"]=0;
                    }
                }
            }
        }
        return $result;
    }

    public function listeEspeces()
    {
        $query = "select * from espece_elevage";
        $stmt = $this->db->query($query);

        return $data = $stmt->fetchAll();
    }
}
