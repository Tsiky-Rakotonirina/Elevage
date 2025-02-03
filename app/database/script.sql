create table eleveur_elevage(
    id int auto_increment primary key,
    nom varchar(50),
    mot de passe varchar(50)
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
    image varchar(100),
    poids int,
    etat boolean default true,
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
    nbPortion int,
    date date,
    foreign key (idEspece) references espece_elevage(id)
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
