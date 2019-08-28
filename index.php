<?php

session_start();

//Développement
define('ENVIRONNEMENT','DEBUG');

if(ENVIRONNEMENT === 'DEBUG'){
  error_reporting(E_ALL);
  ini_set('display_errors',1);
}

setlocale(LC_CTYPE, 'fr_FR.UTF8');
setlocale(LC_TIME, 'fr_FR', 'fra');
//setlocale(LC_ALL, 'fr_FR.utf8');
date_default_timezone_set('Europe/Paris');
mb_internal_encoding("UTF-8");


//Informations base de données
define('BDONNEES', array(
  'pilote'=>'mysql',
  'hote'=>'localhost',
  'bdd'=>'orchestre',
  'utilisateur'=>'',
  'mpasse'=>'',
  'charset'=>'utf8',
  'options'=>array(PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION),
  'tableParDefaut'=>'effectif')
);


//Structure dossiers
define('SEPARATEUR', DIRECTORY_SEPARATOR);
define('RACINE', dirname(__FILE__));

define('APPLICATION','application');
//define('PATRONS', APPLICATION . SEPARATEUR . 'vues' . SEPARATEUR . 'patrons' . SEPARATEUR);
define('PATRONS', APPLICATION . SEPARATEUR . 'patrons' . SEPARATEUR);

define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL', URL_PROTOCOL . URL_DOMAIN . '/');

//Titre
define('TITRE','Effectif orchestral');
//Motto
define('MOTTO','Accueil');

function chargeur($nomClasse){
  $fichier = APPLICATION . SEPARATEUR . 'classes/' . $nomClasse . '.php';
  if (file_exists($fichier)){
    require_once($fichier);
  }
}

spl_autoload_register('chargeur');


$orch = new Orchestre(BDONNEES);



