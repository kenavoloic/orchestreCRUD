# Orchestre

Gestion de l’effectif d’un orchestre symphonique.

Web-application de type CRUD. Toutes les opérations sont accessibles à partir des quatre menus principaux : *Lecture* pour consulter la base de données, *Création* pour recruter un musicien, *Modification* pour éditer les informations et finalement *Suppression*. *Accueil* vous présente une vue synthétique de l’effectif opérationnel.

L’effectif opérationnel s’entend comme l’ensemble des musiciens dont l’âge est supérieur à 18 ans et inférieur à 65 ans. Cet ensemble sert de support à toutes les opérations de la base de données. Les items *Retraite* des menus *Lecture*, *Modification* et *Suppression* permettent d’accéder à  ces informations.

Les informations sont présentées sous forme de tableaux. Il est possible de réordonner les données de chaque tableau en cliquant sur les entêtes.

Seules les fonctionnalités essentielles sont implémentées. 

## Technologies utilisées

* HTML5
* CSS3
* Javascript
* LAMP
* Apache Server
* MySQL 
* PHP 
* Debian

## À faire

L’application est un *work in progress*.

### Fonctionnalités
* Rendre les lignes de tableau *cliquables*.
* Nombre de représentations.
* Lieu des représentations.
* Personnel administratif et technique.

### Programmation PHP
* Simplification du code.
* Adoption d’une approche fonctionnelle et transformation des dernières boucles *foreach*.
* Reprendre array_walk_recursive.

## Installation

* Créez la base de données *orchestre*. Puis chargez les fichiers sql du dossier *data* :

`mysql -u utilisateur -p <  effectif.sql`

`mysql -u utilisateur -p <  genres.sql`

`mysql -u utilisateur -p <  instruments.sql`

`mysql -u utilisateur -p <  pays.sql`

`mysql -u utilisateur -p <  vues.sql`

`mysql -u utilisateur -p <  rapport.sql`

* Indiquez le nom d’utilisateur *utilisateur* et le mot de passe *mpasse* dans *index.php*.




