-- Données de test pour la table `eleveur_elevage`
INSERT INTO eleveur_elevage (id, nom, MotDePasse) VALUES
(1, 'Jean Dupont', 'password123'),
(2, 'Marie Curie', 'securepass'),
(3, 'Paul Martin', 'mypassword'),
(4, 'Pierre', 'Pierre');

-- Données de test pour la table `rubrique_elevage`
INSERT INTO rubrique_elevage (id, nom, effet) VALUES
(1, 'Achat Alimentation', -1),
(2, 'Depot', 1),
(3, 'Achat Animal', -1),
(4, 'Vente Animal', 1);

-- Données de test pour la table `mouvementSolde_elevage`
INSERT INTO mouvementSolde_elevage (id, idEleveur, idRubrique, montant) VALUES
(1, 1, 1, 100),
(2, 2, 2, 200),
(3, 3, 3, 150);

-- Données de test pour la table `espece_elevage`
INSERT INTO espece_elevage (id, nom, image, poidsMax, poidsMinVente, nbJourFaim, prixVenteKg, pertePoidsJour) VALUES
(1, 'Boeuf', '/public/assets/images/boeuf.jpg', 800, 500, 7, 5, 2),
(2, 'Lapin', '/public/assets/images/lapin.jpg', 5, 3, 2, 10, 1),
(3, 'Canard', '/public/assets/images/canard.jpg', 6, 4, 3, 12, 1),
(4, 'Chevre', '/public/assets/images/chevre.jpg', 60, 40, 5, 8, 2),
(5, 'Coq', '/public/assets/images/coq.jpg', 7, 5, 3, 15, 1),
(6, 'Dindon', '/public/assets/images/dindon.jpg', 10, 7, 4, 20, 2),
(7, 'Mouton', '/public/assets/images/mouton.jpg', 70, 50, 6, 10, 3),
(8, 'Poule', '/public/assets/images/poule.jpg', 4, 2, 2, 8, 1);

-- Données de test pour la table `animal_elevage`
INSERT INTO animal_elevage (id, idEleveur, idEspece, poids) VALUES
(1, 1, 1, 600),
(2, 2, 2, 4),
(3, 3, 3, 250),
(4, 1, 4, 55),
(5, 2, 5, 6),
(6, 3, 6, 9),
(7, 1, 7, 65),
(8, 2, 8, 3);

-- Données de test pour la table `alimentation_elevage`
INSERT INTO alimentation_elevage (id, nom,prix) VALUES
(1, 'Foin',20),
(2, 'Grains',50),
(3, 'Maïs',10);

-- Données de test pour la table `detailsAlimentation_elevage`
INSERT INTO detailsAlimentation_elevage (id, idEspece, idAlimentation, gain) VALUES
(1, 1, 1, 50),
(2, 2, 2, 30),
(3, 3, 3, 40);

-- Données de test pour la table `alimenter_elevage`
INSERT INTO alimenter_elevage (id, idAnimal, idDetailsAlimentation, nbPortion, date) VALUES
(1, 1, 1, 3, '2023-01-01'),
(2, 2, 2, 2, '2023-01-02'),
(3, 3, 3, 4, '2023-01-03');

-- Données de test pour la table `achatAlimentation_elevage`
INSERT INTO achatAlimentation_elevage (id, idEleveur, idAlimentation, date, nbPortion) VALUES
(1, 1, 1, '2023-01-01', 10),
(2, 2, 2, '2023-01-02', 20),
(3, 3, 3, '2023-01-03', 30);

-- Données de test pour la table `stockAlimentation_elevage`
INSERT INTO stockAlimentation_elevage (id, idEleveur, idAlimentation, nbPortion) VALUES
(1, 1, 1, 10),
(2, 2, 2, 20),
(3, 3, 3, 30);
