<?php

interface OLVInterface {
  
  const whitelist = array(
    'accueil' => ['index'],
    'lecture' => ['index','fonction','groupe'],
    'modification' => ['index','fonction','groupe','maj','recrutementModification'],
    'suppression' => ['index','fonction','groupe','sup','recrutementSuppression'],
    'creation' => ['creationFonction','recrutementCreation']
  );
  
  const listeActions = ['creation','modification','suppression'];

  //Noms des vues créées dans la base de données

  const listeFonctionsOrchestrales = array(
    "effectif_operationnel", "effectif_chronologique_desc", "effectif_complet", "effectif_retraite", "effectif_nationalites", "effectif_femmes", "effectif_hommes", "direction", "premierviolon", "secondviolon", "alto", "violoncelle", "contrebasse", 
    "piccolo", "flute", "hautbois", "coranglais", "clarmi", "clarsi", "clarb", "basson", "contrebasson", "saxophone", "trompette", "corharmonie", "trombone", "tuba", "timbale", "percussions", "harpe", "claviers"
  );

  const listeFonctionsOrchestralesIntitules = array(
    "effectif_complet" => "Effectif complet",
    "effectif_chronologique_desc" => "Effectif chronologique", 
    "effectif_operationnel" => "Effectif opérationnel", 
    "effectif_retraite" => "Effectif à la retraite", 
    "effectif_nationalites" => "Effectif par nationalités", 
    "effectif_femmes" => "Femmes de l’orchestre", 
    "effectif_hommes" => "Hommes de l’orchestre", 
    "direction" => "Direction", 
    "premierviolon" => "Premiers violons", 
    "secondviolon" => "Seconds violons", 
    "alto" => "Violons alto", 
    "violoncelle" => "Violoncelle", 
    "contrebasse" => "Contrebasse", 
    "piccolo" => "Flûte piccolo", 
    "flute" => "Flûtes en Ut", 
    "hautbois" => "Hautbois", 
    "coranglais" => "Cor anglais", 
    "clarmi" => "Clarinettes en Mi", 
    "clarsi" => "Clarinettes en Si", 
    "clarb" => "Clarinettes basses", 
    "basson" => "Basson", 
    "contrebasson" => "Contrebasson", 
    "saxophone" => "Saxophone", 
    "trompette" => "Trompette", 
    "corharmonie" => "Cor d’harmonie", 
    "trombone" => "Trombone", 
    "tuba" => "Tuba", 
    "timbale" => "Timbales", 
    "percussions" => "Percussions", 
    "harpe" => "Harpe", 
    "claviers" => "Claviers");

  const listeRequetesSQL = array(
    "effectif_complet" => "select * from vue_effectif_complet;",
    "effectif_chronologique_desc" => "select * from vue_effectif_chronologique_desc;",
    "effectif_operationnel" => "select * from vue_effectif_operationnel;",
    "effectif_retraite" => "select * from vue_effectif_retraite;",
    "effectif_nationalites" => "select * from vue_effectif_nationalites;",
    "effectif_femmes" => "select * from vue_effectif_femmes;",
    "effectif_hommes" => "select * from vue_effectif_hommes;",
    "direction" => "select * from vue_direction;",
    "premierviolon" => "select * from vue_premierviolon;",
    "secondviolon" => "select * from vue_secondviolon;",
    "alto" => "select * from vue_alto;",
    "violoncelle" => "select * from vue_violoncelle;",
    "contrebasse" => "select * from vue_contrebasse;",
    "piccolo" => "select * from vue_piccolo;",
    "flute" => "select * from vue_flute;",
    "hautbois" => "select * from vue_hautbois;",
    "coranglais" => "select * from vue_coranglais;",
    "clarmi" => "select * from vue_clarinettemi;",
    "clarsi" => "select * from vue_clarinettesi;",
    "clarb" => "select * from vue_clarinettebasse;",
    "basson" => "select * from vue_basson;",
    "contrebasson" => "select * from vue_contrebasson;",
    "saxophone" => "select * from vue_saxophone;",
    "trompette" => "select * from vue_trompette;",
    "corharmonie" => "select * from vue_corharmonie;",
    "trombone" => "select * from vue_trombone;",
    "tuba" => "select * from vue_tuba;",
    "timbale" => "select * from vue_timbale;",
    "percussions" => "select * from vue_percussions;",
    "harpe" => "select * from vue_harpe;",
    "claviers" => "select * from vue_claviers;"
  );

  const listeGroupes = ["cordes", "bois", "cuivres", "autres"];

  const listeRequetesSQLGroupes = array(
    "cordes" => "select * from vue_groupe_cordes", 
    "bois" => "select * from vue_groupe_bois", 
    "cuivres"=> "select * from vue_groupe_cuivres", 
    "autres" => "select * from vue_groupe_autres"
  );

  const listeGroupesIntitules = array(
    "direction" => "Direction", 
    "cordes" => "Cordes", 
    "bois" => "Bois", 
    "cuivres"=> "Cuivres", 
    "autres" => "Autres"
  );

  const dictionnaire = array(
    'annee' => 'année',
    'civilite'=>'civilité',
    'deces' => 'décès',
    'id'=>'ID',
    'nationalite'=>'nationalité',
    'nationalites'=>'nationalités',
    'prenom'=>'prénom',
    'anciennete' => 'ancienneté'
  );

  const attributsDonnees = array(
    'id' => 'entier',
    'genre' =>  'chaine',
    'sexe' => 'chaine',
    'civilite' =>  'chaine',
    'nom' => 'chaine',
    'prenom' => 'chaine',
    'naissance' => 'date',
    'age' => 'entier',
    'ville' => 'chaine',
    'courriel' => 'chaine',
    'fonction' => 'fonction',
    'groupe' => 'groupe',
    'instrument' => 'chaine',
    'pays' => 'chaine',
    'modification' => 'chaine',
    'suppression' => 'chaine',
    'anciennete' => 'entier',
    'recrutement' => 'date'
  );

  const casse = [
    'civilite',
    'genre',
    'groupe',
    'nom',
    'prenom',
    'sexe',
    'ville'
  ];

  const rubriques = array(
    'lecture'=>'Consultation de la ',
    'creation'=>'',
    'modification'=>'',
    'suppression'=>''    
  );

}
