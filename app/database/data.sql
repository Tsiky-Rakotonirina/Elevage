-- Insert test data for eleveur_elevage
INSERT INTO eleveur_elevage (nom, MotDePasse) VALUES 
('Eleveur1', 'password1'),
('Eleveur2', 'password2');

-- Insert test data for rubrique_elevage
INSERT INTO rubrique_elevage (id, nom, effet) VALUES 
(1, 'Rubrique1', 10),
(2, 'Rubrique2', 20);

-- Insert test data for espece_elevage
INSERT INTO espece_elevage (nom, image, poidsMax, poidsMinVente, nbJourFaim, prixVenteKg, pertePoidsJour) VALUES 
('Espece1', '/public/assets/images/boeuf1.jpg', 100, 50, 3, 10, 1),
('Espece2', '/public/assets/images/canard1.jpg',200, 100, 5, 20, 2);

-- Insert test data for animal_elevage
INSERT INTO animal_elevage (idEleveur, idEspece, poids) VALUES 
(1, 1, 60),
(1, 2, 150),
(2, 1, 70);

-- Insert test data for alimentation_elevage
INSERT INTO alimentation_elevage (nom) VALUES 
('Alimentation1'),
('Alimentation2');

-- Insert test data for detailsAlimentation_elevage
INSERT INTO detailsAlimentation_elevage (idEspece, idAlimentation, gain) VALUES 
(1, 1, 5),
(2, 2, 10);

-- Insert test data for alimenter_elevage
INSERT INTO alimenter_elevage (idAnimal, idDetailsAlimentation, nbPortion, date) VALUES 
(1, 1, 2, '2023-10-01'),
(2, 2, 3, '2023-10-02'),
(3, 1, 1, '2023-10-03');

-- Insert test data for achatAlimentation_elevage
INSERT INTO achatAlimentation_elevage (idEleveur, idAlimentation, date, nbPortion) VALUES 
(1, 1, '2023-10-01', 10),
(2, 2, '2023-10-02', 20);

-- Insert test data for stockAlimentation_elevage
INSERT INTO stockAlimentation_elevage (idEleveur, idAlimentation, nbPortion) VALUES 
(1, 1, 5),
(2, 2, 10);

-- Insert test data for transactionAnimal_elevage
INSERT INTO transactionAnimal_elevage (idEleveurAcheteur, idAnimal, prix, date) VALUES 
(1, 1, 100, '2023-10-01'),
(2, 2, 200, '2023-10-02');
