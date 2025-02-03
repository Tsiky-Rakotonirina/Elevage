CREATE OR REPLACE VIEW V_AnimalEspece AS
SELECT 
    a.id AS animal_id,
    a.idEleveur,
    e.image,
    a.poids,
    e.id AS espece_id,
    e.nom AS espece_nom,
    e.poidsMax,
    e.poidsMinVente,
    e.nbJourFaim,
    e.prixVenteKg,
    e.pertePoidsJour
FROM 
    animal_elevage a
JOIN 
    espece_elevage e ON a.idEspece = e.id;

<<<<<<< HEAD


SELECT   ae.id AS alimenter_id, ae.idAnimal, ae.nbPortion, ae.date, ae.idDetailsAlimentation, da.id as detail_id , da.idEspece , da.idAlimentation , da.gain FROM alimenter_elevage ae
JOIN detailsAlimentation_elevage da ON ae.idDetailsAlimentation = da.id WHERE ae.date < '2025-02-03';
=======
CREATE OR REPLACE VIEW V_MouvementRubrique AS 
SELECT 
    m.id as mouvement_id,
    m.idEleveur,
    m.idRubrique as rubrique_id,
    m.montant,
    m.date,
    r.nom,
    r.effet
FROM 
    mouvementSolde_elevage m
JOIN
    rubrique_elevage r on m.idRubrique=r.id;
>>>>>>> main
