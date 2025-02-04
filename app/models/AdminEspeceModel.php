<?php

namespace app\models;

use Flight;

class AdminEspeceModel
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listeEspeces() {
        $query = "select * from espece_elevage";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $data= $stmt->fetchAll(); 
        return $data;
    }

    public function modifierEspeceNom($id, $nom) {
        $query="UPDATE espece_elevage SET nom=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $data=array($nom, $id);
        $stmt->execute($data);
    }

    public function modifierEspeceImage($id, $image) {
        $query="UPDATE espece_elevage SET image=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $data=array($image, $id);
        $stmt->execute($data);
    }

    public function modifierEspecePoidsMax($id, $poidsMax) {
        $query="UPDATE espece_elevage SET poidsMax=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $data=array($poidsMax, $id);
        $stmt->execute($data);
    }

    public function modifierEspecePoidsMinVente($id, $poidsMinVente) {
        $query="UPDATE espece_elevage SET poidsMinVente=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $data=array($poidsMinVente, $id);
        $stmt->execute($data);
    }

    public function modifierEspeceNbJourFaim($id, $nbJourFaim) {
        $query="UPDATE espece_elevage SET nbJourFaim=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $data=array($nbJourFaim, $id);
        $stmt->execute($data);
    }

    public function modifierEspecePrixVenteKg($id, $prixVenteKg) {
        $query="UPDATE espece_elevage SET prixVenteKg=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $data=array($prixVenteKg, $id);
        $stmt->execute($data);
    }

    public function modifierEspeceQuotaJournalier($id, $quotaJournalier) {
        $query="UPDATE espece_elevage SET quotaJournalier=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $data=array($quotaJournalier, $id);
        $stmt->execute($data);
    }

    public function modifierEspecePertePoidsJour($id, $pertePoidsJour) {
        $query="UPDATE espece_elevage SET pertePoidsJour=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $data=array($pertePoidsJour, $id);
        $stmt->execute($data);
    }
    
}
