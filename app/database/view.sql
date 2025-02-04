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