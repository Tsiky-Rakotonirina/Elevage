-- Données de test pour la table `eleveur_elevage`
INSERT INTO eleveur_elevage (id, nom, MotDePasse) VALUES
(9999,'Admin','Admin'),
(1, 'Pierre ', 'Pierre'),
(2, 'Marie Curie', 'securepass'),
(3, 'Paul Martin', 'mypassword');

INSERT INTO admin_elevage (id, nom, MotDePasse) VALUES
(1, 'Ezechiel', 'Ezechiel');

-- Insertion des images dans la table `caroussel`
INSERT INTO caroussel (image) VALUES
('/public/assets/caroussel/boeuf1.jpg'),
('/public/assets/caroussel/canard1.jpg'),
('/public/assets/caroussel/chevre1.jpg'),
('/public/assets/caroussel/coq1.jpg'),
('/public/assets/caroussel/boeuf2.jpg'),
('/public/assets/caroussel/coq2.jpg'),
('/public/assets/caroussel/coq3.jpg'),
('/public/assets/caroussel/boeuf3.jpg'),
('/public/assets/caroussel/lapin2.jpg'),
('/public/assets/caroussel/boeuf4.jpg'),
('/public/assets/caroussel/canard2.jpg'),
('/public/assets/caroussel/chevre2.jpg'),
('/public/assets/caroussel/chevre3.jpg'),
('/public/assets/caroussel/coq4.jpg'),
('/public/assets/caroussel/dindon1.jpg'),
('/public/assets/caroussel/mouton2.jpg'),
('/public/assets/caroussel/lapin1.jpg'),
('/public/assets/caroussel/dindon2.jpg'),
('/public/assets/caroussel/lapin3.jpg'),
('/public/assets/caroussel/mouton1.jpg'),
('/public/assets/caroussel/mouton3.jpg');

-- Données de test pour la table `rubrique_elevage`
INSERT INTO rubrique_elevage (id, nom, effet) VALUES
(1, 'Achat Alimentation', -1),
(2, 'Depot', 1),
(3, 'Achat Animal', -1),
(4, 'Vente Animal', 1);

-- Données de test pour la table `mouvementSolde_elevage`
INSERT INTO mouvementSolde_elevage (id, idEleveur, idRubrique, montant,date) VALUES
(1, 1, 2, 100,now()),
(2, 2, 2, 200,now()),
(3, 3, 3, 150,now());

-- Données de test pour la table `espece_elevage`
INSERT INTO espece_elevage (id, nom, image, poidsMax, poidsMinVente, nbJourFaim, prixVenteKg, pertePoidsJour, quotaJournalier) VALUES
(1, 'Boeuf', '/public/assets/images/boeuf.jpg', 800, 500, 7, 5, 2, 10),
(2, 'Lapin', '/public/assets/images/lapin.jpg', 5, 3, 2, 10, 1, 2),
(3, 'Canard', '/public/assets/images/canard.jpg', 6, 4, 3, 12, 1, 3),
(4, 'Chevre', '/public/assets/images/chevre.jpg', 60, 40, 5, 8, 2, 5),
(5, 'Coq', '/public/assets/images/coq.jpg', 7, 5, 3, 15, 1, 3),
(6, 'Dindon', '/public/assets/images/dindon.jpg', 10, 7, 4, 20, 2, 4),
(7, 'Mouton', '/public/assets/images/mouton.jpg', 70, 50, 6, 10, 3, 6),
(8, 'Poule', '/public/assets/images/poule.jpg', 4, 2, 2, 8, 1, 2);

-- Données de test pour la table `animal_elevage`
INSERT INTO animal_elevage (id, idEleveur, idEspece, poidsInitial, autoVente, dateVente, dateMort) VALUES
(1, 1, 1, 600, true, null, '2025-02-01'),
(2, 2, 2, 4, false, '2025-01-15', '2025-02-15'),
(3, 3, 3, 250, true, null, '2025-02-20'),
(4, 1, 4, 55, false, '2025-01-25', '2025-02-25'),
(5, 2, 5, 6, true, null, '2025-02-28'),
(6, 3, 6, 9, false, '2025-02-05', '2025-03-05'),
(7, 1, 7, 65, true,null, '2025-03-10'),
(8, 9999, 7, 30, null, null, '2025-03-15'),
(9, 9999, 8, 50, null, null, '2025-03-15'),
(10, 9999, 6, 10, null, null, '2025-03-15'),
(11, 9999, 5, 31, null, null, '2025-03-15');

-- Données de test pour la table `transactionAnimal_elevage`
INSERT INTO transactionAnimal_elevage (id, idAnimal, prix, date, vendu) VALUES
(1, 8, 300, '2025-03-16', false),
(2, 9, 500, '2025-03-17', false),
(3, 10, 150, '2025-03-18', false),
(4, 11, 200, '2025-03-19', false);

-- Données de test pour la table `alimentation_elevage`
INSERT INTO alimentation_elevage (id, nom, prix) VALUES
(1, 'Foin',20),
(2, 'Grains',50),
(3, 'Maïs',10),
(4,'Carotte',30),
(5, 'Herbe', 15),
(6, 'Légumes', 35);

-- Données de test pour la table `detailsAlimentation_elevage`
INSERT INTO detailsAlimentation_elevage (id, idEspece, idAlimentation, gain) VALUES
(1, 1, 1, 50),
(2, 1, 2, 40),
(3, 1, 3, 30),
(4, 2, 1, 20),
(5, 2, 2, 30),
(6, 2, 3, 25),
(7, 3, 1, 35),
(8, 3, 2, 45),
(9, 3, 3, 40),
(10, 4, 1, 50),
(11, 4, 2, 55),
(12, 4, 3, 60),
(13, 5, 1, 20),
(14, 5, 2, 25),
(15, 5, 3, 30),
(16, 6, 1, 40),
(17, 6, 2, 45),
(18, 6, 3, 50),
(19, 7, 1, 30),
(20, 7, 2, 35),
(21, 7, 3, 40),
(22, 8, 1, 25),
(23, 8, 2, 30),
(24, 8, 3, 35);
 
 INSERT INTO detailsAlimentation_elevage (id, idEspece, idAlimentation, gain) VALUES
(25, 1,4, 50),
(26, 1, 5, 40),
(27, 1, 6, 30),
(28, 2,4, 50),
(29, 2, 5, 40),
(30, 2, 6, 30),

(31, 3,4, 50),
(32, 3, 5, 40),

(33, 3, 6, 30),
(34, 4,4, 50),

(35, 4, 5, 40),
(36, 4, 6, 30),

(37, 5,4, 50),
(38, 5, 5, 40),

(39, 5, 6, 30),
(40, 6,4, 50),

(41, 6, 5, 40),
(42, 6, 6, 30);

INSERT INTO detailsAlimentation_elevage (id, idEspece, idAlimentation, gain) VALUES
(43,7,4,10),

(44,7,5,80),

(45,7,6,70),
(46,8,4,10),

(47,8,5,80),

(48,8,6,70);

-- Données de test pour la table `stockAlimentation_elevage`
INSERT INTO stockAlimentation_elevage (id, idEleveur, idAlimentation, nbPortion) VALUES
(1, 1, 1, 500),
(2, 2, 2, 500),
(3, 3, 3, 30);
