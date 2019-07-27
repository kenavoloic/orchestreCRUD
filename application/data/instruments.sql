USE orchestre;
DROP TABLE IF EXISTS instruments;

CREATE TABLE instruments (
instrument_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom varchar(16) NOT NULL,
nomcomplet VARCHAR(64) NOT NULL,
groupe VARCHAR(16) NOT NULL
);
INSERT INTO instruments(nom, nomcomplet, groupe) VALUES
('chef','Chef d’orchestre','direction'),
-- "Cordes"
('v1','Premier violon','cordes'),
('v2','Second violon','cordes'),
('alto','Alto','cordes'),
('vlc','Violoncelle','cordes'),
('cb','Contrebasse','cordes'),
--  "Bois"
('picc','Piccolo','bois'),
('fl','Flûte traversière','bois'),
('htb','Hautbois','bois'),
('coranglais','Cor anglais','bois'),
('clarmi','Petite clarinette','bois'),
('clarsi','Grande clarinette','bois'),
('clarb','Clarinette basse','bois'),
('bsn','Basson','bois'),
('cbsn','Contrebasson','bois'),
('sax','Saxophone','bois'),
--  "Cuivres"
('trp','Trompette','cuivres'),
('corharmonie','Cor d’harmonie','cuivres'),
('trb','Trombone','cuivres'),
('tub','Tuba','cuivres'),
--  "Autres"
('timb','Timbales','autres'),
('perc','Percussions','autres'),
('hp','Harpe','autres'),
('claviers','Claviers','autres'),
-- ('chef','Chef d’orchestre','autres'),
-- Inconnu
('','Non renseigné.', 'inconnu')
;

