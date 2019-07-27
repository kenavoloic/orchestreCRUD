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
* Date de recrutement.
* Nombre de représentations.
* Lieu des représentations.
* Personnel administratif et technique.

### Programmation PHP
* Adoption d’une approche fonction et transformation des boucles foreach
* Héritage ou composition : utilisation d’une classe dont hériteront les classes *Accueil*, *Lecture*, *Modification* et *Suppression* ou maintien de la composition.







