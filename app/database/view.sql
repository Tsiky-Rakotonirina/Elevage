CREATE VIEW V_AnimalEspece AS
SELECT 
    a.id AS animal_id,
    a.idEleveur,
    a.image,
    a.poids,
    a.etat,
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