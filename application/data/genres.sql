USE orchestre;
DROP TABLE IF EXISTS genres;
CREATE TABLE genres (
genre_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
sexe VARCHAR(10),
civilite VARCHAR(16)
);

-- INSERT INTO genres(sexe,civilite) 
INSERT INTO genres VALUES
(DEFAULT, 'f','madame'),
(DEFAULT, 'h','monsieur'),
(DEFAULT, '','Non renseigné.');
