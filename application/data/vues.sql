use orchestre;

-- effectif: complet, opérationnel, retraite, nationalites, femmes, hommes

drop view if exists vue_effectif_complet;
create view vue_effectif_complet as select effectif.id, effectif.genre, effectif.nom, effectif.prenom, instruments.groupe, instruments.nomcomplet as fonction,   date_format(effectif.naissance, '%d-%m-%Y') as naissance, timestampdiff(year, effectif.naissance, curdate()) as age,       pays.nom as pays, effectif.ville, effectif.courriel from effectif
left join genres on (effectif.genre = genres.sexe)
left join instruments on (effectif.fonction = instruments.nom)
left join pays on (effectif.nationalite = pays.iso)
order by field(groupe,'direction','cordes','bois','cuivres','autres'), instruments.instrument_id,  nom, prenom, genre, age, pays;

drop view if exists vue_effectif_operationnel;
create view vue_effectif_operationnel as select effectif.id, effectif.genre, effectif.nom, effectif.prenom, instruments.groupe, instruments.nomcomplet as fonction,   date_format(effectif.naissance, '%d-%m-%Y') as naissance, timestampdiff(year, effectif.naissance, curdate()) as age,       pays.nom as pays, effectif.ville, effectif.courriel from effectif
left join genres on (effectif.genre = genres.sexe)
left join instruments on (effectif.fonction = instruments.nom)
left join pays on (effectif.nationalite = pays.iso)
having age between 18 and 65
order by field(groupe,'direction','cordes','bois','cuivres','autres'), instruments.instrument_id,  nom, prenom, genre, age, pays;

drop view if exists vue_procedure;
create view vue_procedure as select effectif.id, effectif.genre, effectif.nom, effectif.prenom, instruments.groupe, fonction, date_format(effectif.naissance, '%d-%m-%Y') as naissance, timestampdiff(year, effectif.naissance, curdate()) as age, pays.nom as pays, effectif.ville, effectif.courriel from effectif
left join genres on (effectif.genre = genres.sexe)
left join instruments on (effectif.fonction = instruments.nom)
left join pays on (effectif.nationalite = pays.iso)
having age between 18 and 65
order by field(groupe,'direction','cordes','bois','cuivres','autres'), instruments.instrument_id,  nom, prenom, genre, age, pays;

drop view if exists vue_effectif_chronologique_desc;
create view vue_effectif_chronologique_desc as select effectif.id, effectif.genre, effectif.nom, effectif.prenom, instruments.groupe, instruments.nomcomplet as fonction,  effectif.ville, pays.nom as pays,  timestampdiff(year, effectif.naissance, curdate()) as age,   effectif.courriel from effectif
left join genres on (effectif.genre = genres.sexe)
left join instruments on (effectif.fonction = instruments.nom)
left join pays on (effectif.nationalite = pays.iso)
having age between 18 and 65
order by effectif.id desc, field(groupe,'direction','cordes','bois','cuivres','autres'), instruments.instrument_id, age desc, nom;

drop view if exists vue_effectif_retraite;
create view vue_effectif_retraite as select  effectif.id, genres.civilite, effectif.nom, effectif.prenom, pays.nom as pays, instruments.groupe, instruments.nomcomplet as fonction,  date_format(effectif.naissance, '%d-%m-%Y') as naissance, timestampdiff(year, effectif.naissance, curdate()) as age
from effectif
left join genres on (effectif.genre = genres.sexe)
left join instruments on (effectif.fonction = instruments.nom)
left join pays on (effectif.nationalite = pays.iso)
having age between 65 and 100
order by field(groupe,'direction','cordes','bois','cuivres','autres'), instruments.instrument_id,  age desc, nom;

drop view if exists vue_effectif_nationalites;
create view vue_effectif_nationalites as
select id, pays, genre, nom, prenom,  groupe, fonction  from
vue_effectif_operationnel
order by pays, nom, prenom, field(groupe,'direction','cordes','bois','cuivres','autres'), fonction;


drop view if exists vue_effectif_femmes;
create view vue_effectif_femmes as
select id, nom, prenom,  groupe, fonction, ville, pays, age, courriel from
vue_effectif_operationnel where genre = 'f'
order by field(groupe,'direction','cordes','bois','cuivres','autres'), fonction, nom, age desc;

drop view if exists vue_effectif_hommes;
create view vue_effectif_hommes as
select id, nom, prenom,  groupe, fonction, ville, pays, age, courriel from
vue_effectif_operationnel where genre = 'h'
order by field(groupe,'direction','cordes','bois','cuivres','autres'), fonction, nom, age desc;

-- lectureID

drop view if exists vue_lecture_id;
create view vue_lecture_id as select id, genre, nom, prenom, groupe, fonction, naissance, pays, ville, courriel from vue_effectif_complet;

drop view if exists vue_lecture_mod;
create view vue_lecture_mod as select id, genre, effectif.nom, prenom, instruments.groupe, instruments.nom as fonction, date_format(effectif.naissance, '%d-%m-%Y') as naissance, pays.iso as iso, ville, courriel from effectif
left join instruments on (effectif.fonction = instruments.nom)
left join pays on (effectif.nationalite = pays.iso);


-- vues instrumentales

drop view if exists vue_base_instrumentale;
create view vue_base_instrumentale as select effectif.id, effectif.genre, genres.civilite, effectif.nom, effectif.prenom, instruments.groupe, instruments.nom as abreviation, instruments.nomcomplet as fonction,   date_format(effectif.naissance, '%d-%m-%Y') as naissance, timestampdiff(year, effectif.naissance, curdate()) as age,  pays.nom as pays, effectif.ville, effectif.courriel from effectif
left join genres on (effectif.genre = genres.sexe)
left join instruments on (effectif.fonction = instruments.nom)
left join pays on (effectif.nationalite = pays.iso)
having age between 18 and 65
order by field(groupe,'direction','cordes','bois','cuivres','autres'), instruments.instrument_id,  nom, prenom, genre, age, pays;


drop view if exists vue_direction;
create view vue_direction as
select id, civilite, nom, prenom, age, pays, courriel
from vue_base_instrumentale where abreviation='chef'
order by nom, prenom, genre;

drop view if exists vue_premierviolon;
create view vue_premierviolon as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='v1'
order by nom, prenom, civilite;

drop view if exists vue_secondviolon;
create view vue_secondviolon as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='v2'
order by nom, prenom, civilite;

drop view if exists vue_alto;
create view vue_alto as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='alto'
order by nom, prenom, civilite;

drop view if exists vue_violoncelle;
create view vue_violoncelle as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='vlc'
order by nom, prenom, civilite;

drop view if exists vue_contrebasse;
create view vue_contrebasse as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='cb'
order by nom, prenom, civilite;

drop view if exists vue_piccolo;
create view vue_piccolo as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='picc'
order by nom, prenom, civilite;

drop view if exists vue_flute;
create view vue_flute as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='fl'
order by nom, prenom, civilite;

drop view if exists vue_hautbois;
create view vue_hautbois as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='htb'
order by nom, prenom, civilite;

drop view if exists vue_coranglais;
create view vue_coranglais as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='coranglais'
order by nom, prenom, civilite;

drop view if exists vue_clarinettemi;
create view vue_clarinettemi as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='clarmi'
order by nom, prenom, civilite;

drop view if exists vue_clarinettesi;
create view vue_clarinettesi as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='clarsi'
order by nom, prenom, civilite;

drop view if exists vue_clarinettebasse;
create view vue_clarinettebasse as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='clarb'
order by nom, prenom, civilite;

drop view if exists vue_basson;
create view vue_basson as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='bsn'
order by nom, prenom, civilite;

drop view if exists vue_contrebasson;
create view vue_contrebasson as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='cbsn'
order by nom, prenom, civilite;

drop view if exists vue_saxophone;
create view vue_saxophone as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='sax'
order by nom, prenom, civilite;

drop view if exists vue_trompette;
create view vue_trompette as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='trp'
order by nom, prenom, civilite;

drop view if exists vue_corharmonie;
create view vue_corharmonie as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='corharmonie'
order by nom, prenom, civilite;


drop view if exists vue_trombone;
create view vue_trombone as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='trb'
order by nom, prenom, civilite;


drop view if exists vue_tuba;
create view vue_tuba as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='tub'
order by nom, prenom, civilite;


drop view if exists vue_timbale;
create view vue_timbale as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='timb'
order by nom, prenom, civilite;


drop view if exists vue_percussions;
create view vue_percussions as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='perc'
order by nom, prenom, civilite;


drop view if exists vue_harpe;
create view vue_harpe as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='hp'
order by nom, prenom, civilite;

drop view if exists vue_claviers;
create view vue_claviers as
select id, civilite, nom, prenom, naissance, pays
from vue_base_instrumentale where abreviation='claviers'
order by nom, prenom, civilite;

--------------------------------------------------------------

drop view if exists vue_groupe_cordes;
create view vue_groupe_cordes as
select effectif.id, genres.sexe, effectif.nom, effectif.prenom, date_format(effectif.naissance, '%d-%m-%Y') as naissance, timestampdiff(year, effectif.naissance, curdate()) as age, pays.nom as pays, instruments.nomcomplet as fonction
from effectif
left join genres on (effectif.genre = genres.sexe)
left join instruments on (effectif.fonction = instruments.nom)
left join pays on (effectif.nationalite = pays.iso)
where instruments.groupe='cordes'
having age between 18 and 65
order by instruments.instrument_id, effectif.nom, effectif.prenom;

drop view if exists vue_groupe_bois;
create view vue_groupe_bois as
select effectif.id, genres.sexe, effectif.nom, effectif.prenom, date_format(effectif.naissance, '%d-%m-%Y') as naissance, timestampdiff(year, effectif.naissance, curdate()) as age, pays.nom as pays, instruments.nomcomplet as fonction
from effectif
left join genres on (effectif.genre = genres.sexe)
left join instruments on (effectif.fonction = instruments.nom)
left join pays on (effectif.nationalite = pays.iso)
where instruments.groupe='bois'
having age between 18 and 65
order by instruments.instrument_id, effectif.nom, effectif.prenom;

drop view if exists vue_groupe_cuivres;
create view vue_groupe_cuivres as
select effectif.id, genres.sexe, effectif.nom, effectif.prenom, date_format(effectif.naissance, '%d-%m-%Y') as naissance, timestampdiff(year, effectif.naissance, curdate()) as age, pays.nom as pays, instruments.nomcomplet  as fonction
from effectif
left join genres on (effectif.genre = genres.sexe)
left join instruments on (effectif.fonction = instruments.nom)
left join pays on (effectif.nationalite = pays.iso)
where instruments.groupe='cuivres'
having age between 18 and 65
order by instruments.instrument_id, effectif.nom, effectif.prenom;

drop view if exists vue_groupe_autres;
create view vue_groupe_autres as
select effectif.id, genres.sexe, effectif.nom, effectif.prenom, date_format(effectif.naissance, '%d-%m-%Y') as naissance, timestampdiff(year, effectif.naissance, curdate()) as age, pays.nom as pays, instruments.nomcomplet  as fonction
from effectif
left join genres on (effectif.genre = genres.sexe)
left join instruments on (effectif.fonction = instruments.nom)
left join pays on (effectif.nationalite = pays.iso)
where instruments.groupe='autres'
having age between 18 and 65
order by instruments.instrument_id, effectif.nom, effectif.prenom;

