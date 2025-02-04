create table admin_elevage(
    id int auto_increment primary key,
    nom varchar(50),
    MotDePasse varchar(50)
);

create table eleveur_elevage(
    id int auto_increment primary key,
    nom varchar(50),
    MotDePasse varchar(50)
);

create table rubrique_elevage(
    id int auto_increment primary key,
    nom varchar(50),
    effet int
);

create table mouvementSolde_elevage(
    id int auto_increment primary key,
    idEleveur int,
    idRubrique int,
    montant int,
    date date,
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
    nom varchar(50),
    prix int
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
    idAnimal int,
    prix int,
    date date,
    vendu boolean,
    foreign key (idAnimal) references animal_elevage(id)
);

create table caroussel(
    image varchar(100)
);
