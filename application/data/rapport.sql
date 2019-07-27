USE orchestre;

DROP PROCEDURE IF EXISTS operationnel;
DROP PROCEDURE IF EXISTS nationalites;
DROP PROCEDURE IF EXISTS direction;
DROP PROCEDURE IF EXISTS cordes;
DROP PROCEDURE IF EXISTS bois;
DROP PROCEDURE IF EXISTS cuivres;
DROP PROCEDURE IF EXISTS autres;


DELIMITER //
CREATE PROCEDURE operationnel()
BEGIN
DECLARE nombre INT DEFAULT 0;
DECLARE groupes INT DEFAULT 0;
DECLARE femmes INT DEFAULT 0;
DECLARE hommes INT DEFAULT 0;
DECLARE nationalites INT DEFAULT 0;
DECLARE direction INT DEFAULT 0;
DECLARE cordes INT DEFAULT 0;
DECLARE bois INT DEFAULT 0;
DECLARE cuivres INT DEFAULT 0;
DECLARE autres INT DEFAULT 0;

SELECT COUNT(id) INTO nombre FROM vue_procedure;
SELECT COUNT(DISTINCT(groupe)) INTO groupes FROM vue_procedure;
SELECT COUNT(groupe) INTO femmes FROM vue_procedure WHERE genre="f";
SELECT COUNT(groupe) INTO hommes FROM vue_procedure WHERE genre="h";
SELECT COUNT(DISTINCT(pays)) INTO nationalites from vue_procedure;
SELECT COUNT(groupe) INTO direction FROM vue_procedure WHERE groupe="direction";
SELECT COUNT(groupe) INTO cordes FROM vue_procedure WHERE groupe="cordes";
SELECT COUNT(groupe) INTO bois FROM vue_procedure WHERE groupe="bois";
SELECT COUNT(groupe) INTO cuivres FROM vue_procedure WHERE groupe="cuivres";
SELECT COUNT(groupe) INTO autres FROM vue_procedure WHERE groupe="autres";
SELECT nombre, femmes, hommes, nationalites, groupes, direction, cordes, bois, cuivres, autres;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE direction()
BEGIN
DECLARE chef INT DEFAULT 0;
SELECT COUNT(id) INTO chef FROM vue_direction;
SELECT chef;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE cordes()
BEGIN
declare v1 int default 0;
declare v2 int default 0;
declare alto int default 0;
declare vlc int default 0;
declare cb int default 0;

select count(fonction) into v1 from vue_procedure where fonction = "v1";
select count(fonction) into v2 from vue_procedure where fonction = "v2";
select count(fonction) into alto from vue_procedure where fonction = "alto";
select count(fonction) into vlc from vue_procedure where fonction = "vlc";
select count(fonction) into cb from vue_procedure where fonction = "cb";
select v1, v2, alto, vlc, cb;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE bois()
BEGIN
DECLARE picc INT DEFAULT 0;
DECLARE fl INT DEFAULT 0;
DECLARE htb INT DEFAULT 0;
DECLARE coranglais INT DEFAULT 0;
DECLARE clarmi INT DEFAULT 0;
DECLARE clarsi INT DEFAULT 0;
DECLARE clarb INT DEFAULT 0;
DECLARE bsn INT DEFAULT 0;
DECLARE cbsn INT DEFAULT 0;
DECLARE sax INT DEFAULT 0;

SELECT COUNT(FONCTION) INTO picc FROM vue_procedure WHERE fonction = "picc";
SELECT COUNT(FONCTION) INTO fl FROM vue_procedure WHERE fonction = "fl";
SELECT COUNT(FONCTION) INTO htb FROM vue_procedure WHERE fonction = "htb";
SELECT COUNT(FONCTION) INTO coranglais FROM vue_procedure WHERE fonction = "coranglais";
SELECT COUNT(FONCTION) INTO clarmi FROM vue_procedure WHERE fonction = "clarmi";
SELECT COUNT(FONCTION) INTO clarsi FROM vue_procedure WHERE fonction = "clarsi";
SELECT COUNT(FONCTION) INTO clarb FROM vue_procedure WHERE fonction = "clarb";
SELECT COUNT(FONCTION) INTO bsn FROM vue_procedure WHERE fonction = "bsn";
SELECT COUNT(FONCTION) INTO cbsn FROM vue_procedure WHERE fonction = "cbsn";
SELECT COUNT(FONCTION) INTO sax FROM vue_procedure WHERE fonction = "sax";
SELECT picc, fl, htb, coranglais, clarmi, clarsi, clarb, bsn, cbsn, sax;
END //
DELIMITER ;


DELIMITER //
create procedure cuivres()
begin
DECLARE trp INT DEFAULT 0;
DECLARE corharmonie INT DEFAULT 0;
DECLARE trb INT DEFAULT 0;
DECLARE tub INT DEFAULT 0;

SELECT COUNT(FONCTION) INTO trp FROM vue_procedure WHERE fonction = "trp";
SELECT COUNT(FONCTION) INTO corharmonie FROM vue_procedure WHERE fonction = "corharmonie";
SELECT COUNT(FONCTION) INTO trb FROM vue_procedure WHERE fonction = "trb";
SELECT COUNT(FONCTION) INTO tub FROM vue_procedure WHERE fonction = "tub";

SELECT trp, corharmonie, trb, tub;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE autres()
BEGIN
DECLARE timb INT DEFAULT 0;
DECLARE perc INT DEFAULT 0;
DECLARE hp INT DEFAULT 0;
DECLARE claviers INT DEFAULT 0;

SELECT COUNT(FONCTION) INTO timb FROM vue_procedure WHERE fonction = "timb";
SELECT COUNT(FONCTION) INTO perc FROM vue_procedure WHERE fonction = "perc";
SELECT COUNT(FONCTION) INTO hp FROM vue_procedure WHERE fonction = "hp";
SELECT COUNT(FONCTION) INTO claviers FROM vue_procedure WHERE fonction = "claviers";
SELECT timb, perc, hp, claviers; 
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE nationalites()
BEGIN
SELECT DISTINCT(pays), COUNT(pays) AS nombre FROM vue_procedure GROUP BY pays ORDER BY COUNT(pays) DESC;
END //
DELIMITER ;


