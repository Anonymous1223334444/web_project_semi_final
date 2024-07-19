DROP TABLE IF EXISTS achat;
DROP TABLE IF EXISTS cours;
DROP TABLE IF EXISTS apprenant;
DROP TABLE IF EXISTS formateur;
DROP TABLE IF EXISTS concepteur_pedagogique;
DROP TABLE IF EXISTS administrateur;
DROP TABLE IF EXISTS mobile_money;
DROP TABLE IF EXISTS credit_card ;


CREATE TABLE apprenant (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255),
    nbr_cours_suivi INT,
    password VARCHAR(100),
    PRIMARY KEY (id)
);

CREATE TABLE formateur (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR (255),
    prenom VARCHAR (255),
    email VARCHAR (255),
    photo_profile VARCHAR (255),
    biographie VARCHAR (255),
    nbr_cours_actif INT,
    nbr_etoile FLOAT,
    password VARCHAR (100),
    PRIMARY KEY (id)
);

CREATE TABLE concepteur_pedagogique ( 
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR (255),
    prenom VARCHAR (255),
    email VARCHAR (255),
    password VARCHAR (100),
    PRIMARY KEY (id)
);

CREATE table administrateur (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR (255),
    prenom VARCHAR (255),
    email VARCHAR (255),
    password VARCHAR (100),
    PRIMARY KEY (id)
);


CREATE table cours (
    id INT NOT NULL AUTO_INCREMENT,	
    titre VARCHAR(255),		    
    categorie VARCHAR(255),		    
    photo VARCHAR(255),			    
    prix FLOAT NOT NULL,			    
    id_formateur INT NOT NULL,
    nbr_etoile FLOAT,	
    description VARCHAR(255),			    
    PRIMARY KEY (id),			    
    FOREIGN KEY (id_formateur) REFERENCES formateur(id) ON DELETE CASCADE
);


CREATE table achat (
    id INT NOT NULL AUTO_INCREMENT,	
    id_cours INT NOT NULL, 		    
    id_apprenant INT NOT NULL,	
    mode_achat VARCHAR(100),
    status VARCHAR(100),	
    date_achat DATETIME,
    PRIMARY KEY (id),			    
    FOREIGN KEY (id_cours) REFERENCES cours(id) ON DELETE CASCADE,  
    FOREIGN KEY (id_apprenant) REFERENCES apprenant(id) ON DELETE CASCADE
);

CREATE table credit_card (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255),			        
    numero INT NOT NULL,          
    date_expiration DATE,	
    code_cvv INT,	
    id_apprenant INT NOT NULL,
    PRIMARY KEY (id),		        
    FOREIGN KEY (id_apprenant) REFERENCES apprenant(id) ON DELETE CASCADE
);

CREATE table mobile_money (
    id INT NOT NULL AUTO_INCREMENT,	
    numero_telephone INT(9) NOT NULL,	    
    id_apprenant INT NOT NULL,	
    PRIMARY KEY (id),
    FOREIGN KEY (id_apprenant) REFERENCES apprenant(id) ON DELETE CASCADE  
);

SET GLOBAL local_infile = 'ON';
LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/web_dev_3/public/database/data/apprenant.csv'
                INTO TABLE apprenant 
                FIELDS TERMINATED by ', '
                ENCLOSED BY '"' 
                LINES TERMINATED by '\n' (nom, prenom, email, nbr_cours_suivi, password);

LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/web_dev_3/public/database/data/formateur.csv'
                INTO TABLE formateur 
                FIELDS TERMINATED by ', '
                ENCLOSED BY '"' 
                LINES TERMINATED by '\n' (nom, prenom, email, photo_profile, biographie, nbr_cours_actif, nbr_etoile, password);

LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/web_dev_3/public/database/data/concepteur_pedagogique.csv'
                INTO TABLE concepteur_pedagogique 
                FIELDS TERMINATED by ', '
                ENCLOSED BY '"' 
                LINES TERMINATED by '\n' (nom, prenom, email, password);

LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/web_dev_3/public/database/data/administrateur.csv'
                INTO TABLE administrateur 
                FIELDS TERMINATED by ', '
                ENCLOSED BY '"' 
                LINES TERMINATED by '\n' (nom, prenom, email, password);

LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/web_dev_3/public/database/data/cours.csv'
                INTO TABLE cours 
                FIELDS TERMINATED by ', ' 
                ENCLOSED BY '"' 
                LINES TERMINATED by '\n' (titre, categorie, photo, prix, id_formateur, nbr_etoile, description);

LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/web_dev_3/public/database/data/achat.csv'
                INTO TABLE achat
                FIELDS TERMINATED by ', ' 
                ENCLOSED BY '"' 
                LINES TERMINATED by '\n' (id_cours, id_apprenant, mode_achat, status, date_achat);

LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/web_dev_3/public/database/data/credit_card.csv'
                INTO TABLE credit_card 
                FIELDS TERMINATED by ', '
                ENCLOSED BY '"' 
                LINES TERMINATED by '\n' (nom, numero, date_expiration, code_cvv, id_apprenant);

LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/web_dev_3/public/database/data/mobile_money.csv'
                INTO TABLE mobile_money
                FIELDS TERMINATED by ', '
                ENCLOSED BY '"'
                LINES TERMINATED by '\n' (numero_telephone, id_apprenant);
