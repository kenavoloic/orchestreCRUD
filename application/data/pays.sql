USE orchestre;
DROP TABLE IF EXISTS pays;

CREATE TABLE pays (
pays_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
iso CHAR(2) NOT NULL,
nom VARCHAR(32) NOT NULL,
zone_geographique VARCHAR(16) NOT NULL
);

INSERT INTO pays (iso, nom, zone_geographique) VALUES
-- UE
('fr','France','Union européenne'),
('de','Allemagne','Union européenne'),
('at','Autriche','Union européenne'),
('be','Belgique','Union européenne'),
('bg','Bulgarie','Union européenne'),
('cy','Chypre','Union européenne'),
('hr','Croatie','Union européenne'),
('dk','Danemark','Union européenne'),
('es','Espagne','Union européenne'),
('ee','Estonie','Union européenne'),
('fi','Finlande','Union européenne'),
('gr','Grèce','Union européenne'),
('hu','Hongrie','Union européenne'),
('ie','Irlande','Union européenne'),
('it','Italie','Union européenne'),
('lv','Lettonie','Union européenne'),
('lt','Lituanie','Union européenne'),
('lu','Luxembourg','Union européenne'),
('mt','Malte','Union européenne'),
('nl','Pays-Bas','Union européenne'),
('pl','Pologne','Union européenne'),
('pt','Portugal','Union européenne'),
('ro','Roumanie','Union européenne'),		
('gb','Royaume-Uni','Union européenne'),
('sk','Slovaquie','Union européenne'),
('si','Slovénie','Union européenne'),
('se','Suède','Union européenne'),
('cz','Tchéquie','Union européenne'),		
-- Hors UE
('au','Australie','Hors UE'),
('br','Brésil','Hors UE'),	      
('ca','Canada','Hors UE'),
('kr','Corée du Sud','Hors UE'),	      
('jp','Japon','Hors UE'),
('no','Norvège','Hors UE'),
('nz','Nouvelle-Zélande','Hors UE'),
('ru','Russie','Hors UE'),
('ch','Suisse','Hors UE'),
('us','USA','Hors UE'),
-- Invalide
('','Non renseigné','Non renseigné');
