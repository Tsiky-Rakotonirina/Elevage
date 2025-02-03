create table eleveur_elevage(
    id int auto_increment primary key,
    nom varchar(50),
    MotDePasse varchar(50)
);

create table rubrique_elevage(
    id int,
    nom varchar(50),
    effet int
);

create table mouvementSolde_elevage(
    id int,
    idEleveur int,
    idRubrique int,
    valeur int,
    foreign key (idEleveur) references eleveur_elevage(id),
    foreign key (idRubrique) references rubrique_elevage(id)
);

create table espece_elevage(
    id int auto_increment primary key,
    nom varchar(50),
    image varchar(100),
    poidsMax int,
    poidsMinVente int,
    nbJourFaim int,
    prixVenteKg int,
    pertePoidsJour int
);

create table animal_elevage(
    id int auto_increment primary key,
    idEleveur int,
    idEspece int,
    poids int,
    foreign key (idEleveur) references eleveur_elevage(id),
    foreign key (idEspece) references espece_elevage(id)
);

create table alimentation_elevage(
    id int auto_increment primary key,
    nom varchar(50)
);

create table detailsAlimentation_elevage(
    id int auto_increment primary key,
    idEspece int,
    idAlimentation int,
    gain int
);

create table alimenter_elevage(
    id int auto_increment primary key,
    idAnimal int,
    idDetailsAlimentation int,
    nbPortion int,
    date date,
    foreign key (idDetailsAlimentation) references detailsAlimentation_elevage(id),
    foreign key (idAnimal) references animal_elevage(id)
);

create table achatAlimentation_elevage(
    id int auto_increment primary key,
    idEleveur int,
    idAlimentation int,
    date date,
    nbPortion int,
    foreign key (idEleveur) references eleveur_elevage(id),
    foreign key (idAlimentation) references alimentation_elevage(id)
);

create table stockAlimentation_elevage(
    id int auto_increment primary key,
    idEleveur int,
    idAlimentation int,
    nbPortion int,
    foreign key (idEleveur) references eleveur_elevage(id),
    foreign key (idAlimentation) references alimentation_elevage(id)
);

create table transactionAnimal_elevage(
    id int auto_increment primary key,
    idEleveurAcheteur int,
    idAnimal int,
    prix int,
    date date,
    foreign key (idEleveurAcheteur) references eleveur_elevage(id),
    foreign key (idAnimal) references animal_elevage(id)
);

-- Query to get the list of animals with their status (alive or dead) based on the given date
SELECT 
    a.id,
    a.idEleveur,
    a.idEspece,
    a.image,
    a.poids,
    CASE 
        WHEN DATEDIFF(?, COALESCE(MAX(al.date), '1900-01-01')) > e.nbJourFaim THEN 'Mort'
        ELSE 'Vivant'
    END AS statut
FROM 
    animal_elevage a
LEFT JOIN 
    alimenter_elevage al ON a.id = al.idAnimal
JOIN 
    espece_elevage e ON a.idEspece = e.id
GROUP BY 
    a.id, a.idEleveur, a.idEspece, a.image, a.poids, e.nbJourFaim;
