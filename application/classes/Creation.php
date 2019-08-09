<?php

class Creation {

  use Outils;
  
  private $dbase;

  private $olv;
  private $dictionnaire;
  private $types;

  private $methode;
  private $parametres;
  private $actions;
  private $requete;
  private $validationNumeroRequete;

  private $listeActions;
  private $listeFonctionsOrchestrales;

  private $genres;
  private $instruments;
  private $nationalites;


  public function __construct(BDonnees $dbase, OrchestreListeVues $olv, string $methode, array $parametres){

    $this->dbase = $dbase;
    $this->olv = $olv;
    $this->listeFonctionsOrchestrales = $this->olv->getListeFonctionsOrchestrales();
    $this->listeActions = $this->olv->getListeActions();
    $this->methode = $methode;
    $this->parametres = (count(array_filter($parametres)) !== 0) ? array_filter($parametres) : [0];

    $this->genres = $this->dbase->getGenres();
    $this->instruments = $this->dbase->getInstruments();
    $this->nationalites = $this->dbase->getNationalites();

    $this->dictionnaire = $this->olv->getDictionnaire();
    $this->types = $this->olv->getAttributsDonnees();

    $this->validationNumeroRequete = function(int $nombre){
      return $nombre > count($this->listeFonctionsOrchestrales) ? 0 : $nombre;
    };
    
    $this->$methode($this->parametres);
  }

  public function creationFonction(array $envoi){
    echo $this->getEnteteHtml();
    echo $this->getBarreMenusHtml();
    echo $this->getFormulaireCreation($this->genres, $this->instruments, $this->nationalites);
    echo $this->getScriptFormulaire();
    echo $this->getBasDePageHtml();
  }

  public function recrutementCreation(){
    $test = $_SERVER['REQUEST_METHOD'] === 'POST' ? TRUE : FALSE;
    if($test === false){
      $this->redirection('accueil');
    }
    
    $envoi = $_POST;
    $musicien = array_filter($envoi, function($x){return $x !== 'Enregistrer'; });
    
    $genre = array_flip(array_column($this->genres, 'sexe'));
    $musicien['genre'] = isset($genre[$musicien['genre']]) ? $musicien['genre'] : '';
    $musicien['nom'] = $this->validationChaine(strtolower($musicien['nom'])) ?? '';
    $musicien['prenom'] = $this->validationChaine(strtolower($musicien['prenom'])) ?? '';
    $musicien['naissance'] = $this->conversionNaissanceJJMMAAAA($musicien['naissance']) ?? null;
    $musicien['ville'] = $this->validationChaine(strtolower($musicien['ville'])) ?? '';
    $musicien['courriel'] = $this->validationCourriel($musicien['courriel']) ?? '';

    $instrument = array_flip(array_column($this->instruments, 'nom'));   
    $musicien['fonction'] = isset($instrument[$musicien['fonction']]) ? $musicien['fonction'] : '';

    $nationalite = array_flip(array_column($this->nationalites, 'iso'));
    $musicien['nationalite'] = isset($nationalite[$musicien['nationalite']]) ? $musicien['nationalite'] : '';

    $musicien['recrutement'] = $this->conversionRecrutementJJMMAAAA($musicien['recrutement']) ?? null;

    if (isset($musicien['genre'], $musicien['nom'], $musicien['naissance'], $musicien['fonction'], $musicien['nationalite'], $musicien['recrutement'])){
      $test = false;
      $this->dbase->ecriture($musicien);

      $_SESSION['musicien'] = $musicien;
      $_SESSION['message'] = "Ajout de ";
      
      $this->redirection('accueil');
    } else {
      $this->redirection('creation/creationFonction/0');
    }
    
  }



}
