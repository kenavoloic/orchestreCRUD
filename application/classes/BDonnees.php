<?php

class BDonnees {

  use Outils;
  
  private $pdo = null;
  private $pilote;
  private $hote; 
  private $bdd; 
  private $utilisateur; 
  private $mpasse; 
  private $charset;
  private $pdo_options;
  private $erreur;

  private $validationNumeroRequete;
  private $validationNumeroRequeteGroupes;

  private $olv;
  private $tableParDefaut;
  private $requeteParDefaut;
  private $listeFonctionsOrchestrales;
  private $listeFonctionsOrchestralesIntitules;

  private $listeRequetesSQL;
  private $listeGroupesIntitules;

  private $genres;
  private $instruments;
  private $nationalites;


  public function __construct(array $configurations, OrchestreListeVues $olv){
    
    $this->pilote = $configurations['pilote'];
    $this->hote = $configurations['hote'];
    $this->bdd = $configurations['bdd'];
    $this->charset = $configurations['charset'];
    $this->dsn = $this->getDsn($this->pilote, $this->hote, $this->bdd, $this->charset);
    
    $this->utilisateur = $configurations['utilisateur'];
    $this->mpasse = $configurations['mpasse'];
    $this->pdo_options = $configurations['options'];
    $this->pdo = $this->getPdo($this->dsn, $this->utilisateur, $this->mpasse, $this->pdo_options);

    $this->tableParDefaut = $configurations['tableParDefaut'];

    $this->olv = $olv;
    $this->listeFonctionsOrchestrales = $this->olv->getListeFonctionsOrchestrales();
    $this->listeRequetesSQL = $this->olv->getlisteRequetesSQL();
    $this->listeFonctionsOrchestralesIntitules = $this->olv->getListeFonctionsOrchestralesIntitules();
    $this->listeGroupes = $this->olv->getListeGroupes();
    $this->listeRequetesSQLGroupes = $this->olv->getListeRequetesSQLGroupes();
    $this->listeGroupesIntitules = $this->olv->getListeGroupesIntitules();

    //Menus

    $this->genres = $this->setGenres();
    $this->instruments = $this->setInstruments();
    $this->nationalites = $this->setNationalites();

    //Closures
    $this->validationNumeroRequete = function(int $numero){
      return $numero > count($this->listeFonctionsOrchestrales) ? 0 : $numero;      
    };

    $this->validationNumeroRequeteGroupes = function(int $numero){
      return $numero > count($this->listeGroupes) ? 0 : $numero;
    };
    
  }

  //Connexion : droits et protocole
  private function getDsn($pilote, $hote, $bdd, $charset){
    return "${pilote}:host=${hote};dbname=${bdd};charset=${charset}";
  }

  private function getPdo($dsn, $utilisateur, $mpasse, $options){
    $retour = null;
    try {
      $retour = new PDO($dsn, $utilisateur, $mpasse, $options);
    }
    catch(PDOException $erreur_pdo){
      $this->erreur = $erreur_pdo->getMessage();
    }
    return $retour;      
  }

  public function lectureVue(int $numeroRequete, $pdo_mode= PDO::FETCH_ASSOC){
    $valide = ($this->validationNumeroRequete)($numeroRequete);
    $texteRequete = $this->listeRequetesSQL[$this->listeFonctionsOrchestrales[$valide]];
    $intitule = $this->listeFonctionsOrchestralesIntitules[$this->listeFonctionsOrchestrales[$valide]];

    $retour = $this->pdo->query($texteRequete)->fetchAll($pdo_mode);
    
    return array('intitule'=>$intitule, 'donnees'=>$retour);
  }

  public function lectureVueGroupe(int $numeroRequete, $pdo_mode = PDO::FETCH_ASSOC){
    $valide = ($this->validationNumeroRequeteGroupes)($numeroRequete);
    $texteRequete = $this->listeRequetesSQLGroupes[$this->listeGroupes[$valide]];
    $intitule = $this->listeGroupesIntitules[$this->listeGroupes[$valide]];
    $retour = $this->pdo->query($texteRequete)->fetchAll($pdo_mode);
    return array('intitule'=>$intitule, 'donnees'=>$retour);
  }

  public function lectureID(int $numeroID, $pdo_mode = PDO::FETCH_ASSOC){
    $texteRequete = "select * from vue_lecture_id where id=:numero;";
    $requete = $this->pdo->prepare($texteRequete);
    $requete->execute(['numero' => $numeroID]);
    $retour = $requete->fetch($pdo_mode);
    return $retour;
  }

  public function lectureModification(int $numeroID, $pdo_mode = PDO::FETCH_ASSOC){
    $texteRequete = "select * from vue_lecture_mod where id=:numero;";
    $requete = $this->pdo->prepare($texteRequete);
    $requete->execute(['numero' => $numeroID]);
    $retour = $requete->fetch($pdo_mode);
    return $retour;
  }

  public function ecriture(array $musicien){
    $table = $this->tableParDefaut;

    $genre = $musicien['genre'];        
    $nom = $musicien['nom'];
    $prenom = $musicien['prenom'];
    $naissance = $musicien['naissance'];
    $ville = $musicien['ville'];
    $courriel = $musicien['courriel'];
    $instrument = $musicien['fonction'];
    $nationalite = $musicien['nationalite'];

    $recrutement = $musicien['recrutement'];
    
    $liste = array($genre, $nom, $prenom, $naissance, $ville, $courriel, $instrument, $nationalite);
    
    $liste = array($genre, $nom, $prenom, $naissance, $ville, $courriel, $instrument, $nationalite, $recrutement);    
    
    /* $requeteSQL = "INSERT INTO " .$table . " (genre, nom, prenom, naissance, ville, courriel, fonction, nationalite) VALUES (:genre, :nom, :prenom, :naissance, :ville, :courriel, :fonction, :nationalite);"; */

    $requeteSQL = "INSERT INTO " .$table . " (genre, nom, prenom, naissance, ville, courriel, fonction, nationalite, recrutement) VALUES (:genre, :nom, :prenom, :naissance, :ville, :courriel, :fonction, :nationalite, :recrutement);";
    
    $requete = $this->pdo->prepare($requeteSQL);
    $requete->execute($musicien);
  }

  public function suppression(int $numeroID){
    $table = $this->tableParDefaut;
    $texteRequete = "delete from " . $table . " where id=:id";
    $requete = $this->pdo->prepare($texteRequete);
    $requete->bindValue('id', $numeroID);
    $requete->execute();    
  }

  public function mise_a_jour(int $numeroID, array $musicien){
    $table = $this->tableParDefaut;
    $genre = $musicien['genre'];        
    $nom = $musicien['nom'];
    $prenom = $musicien['prenom'];
    $naissance = $musicien['naissance'];
    $ville = $musicien['ville'];
    $courriel = $musicien['courriel'];
    $instrument = $musicien['fonction'];
    $nationalite = $musicien['nationalite'];

    //$recrutement = $musicien['recrutement'];
    
    /* $liste = array($genre, $nom, $prenom, $naissance, $ville, $courriel, $instrument, $nationalite, $numeroID);
     * 
     * $requeteSQL = "UPDATE " . $table . " SET  genre = :genre, nom = :nom, prenom = :prenom, naissance = :naissance, ville = :ville, courriel = :courriel, fonction = :fonction, nationalite = :nationalite where id = :id;"; */

    $liste = array($genre, $nom, $prenom, $naissance, $ville, $courriel, $instrument, $nationalite, $numeroID, $recrutement);
    $requeteSQL = "UPDATE " . $table . " SET  genre = :genre, nom = :nom, prenom = :prenom, naissance = :naissance, ville = :ville, courriel = :courriel, fonction = :fonction, nationalite = :nationalite, recrutement = :recrutement where id = :id;";

    
    $requete = $this->pdo->prepare($requeteSQL);
    $requete->execute($musicien);     
  }

  private function setGenres(){
    $texteRequete = "select sexe, civilite from genres where sexe <> ' ';";
    $requete = $this->pdo->prepare($texteRequete);
    $requete->execute();
    $retour = $requete->fetchAll();
    return $retour;    
  }

  private function setInstruments(){
    $texteRequete = "select nom, nomcomplet, groupe  from instruments where nom <> ' ';";
    $requete = $this->pdo->prepare($texteRequete);
    $requete->execute();
    $retour = $requete->fetchAll();
    return $retour;
  }

  private function setNationalites(){
    $texteRequete = "select * from pays where iso <> ' ';";
    $requete = $this->pdo->prepare($texteRequete);
    $requete->execute();
    $retour = $requete->fetchAll();
    return $retour;
  }
  
  public function getGenres(){
    return $this->genres;
  }

  public function getInstruments(){
    return $this->instruments;
  }

  public function getNationalites(){
    return $this->nationalites;
  }

  public function getRapportOperationnel($pdo_mode = PDO::FETCH_ASSOC){
    $requete = "call operationnel();";
    $requete = $this->pdo->prepare($requete);
    $requete->execute();
    return $requete->fetchAll($pdo_mode);
  }

  public function getRapportOperationnelDirection($pdo_mode = PDO::FETCH_ASSOC){
    $requete = "call direction();";
    $requete = $this->pdo->prepare($requete);
    $requete->execute();
    return $requete->fetchAll($pdo_mode);
  }


  public function getRapportOperationnelNationalites($pdo_mode = PDO::FETCH_KEY_PAIR){
    $requete = "call nationalites();";
    $requete = $this->pdo->prepare($requete);
    $requete->execute();
    return $requete->fetchAll($pdo_mode);
  }

  public function getRapportOperationnelCordes($pdo_mode = PDO::FETCH_ASSOC){
    $requete = "call cordes();";
    $requete = $this->pdo->prepare($requete);
    $requete->execute();
    return $requete->fetchAll($pdo_mode);
  }
  
  public function getRapportOperationnelBois($pdo_mode = PDO::FETCH_ASSOC){
    $requete = "call bois();";
    $requete = $this->pdo->prepare($requete);
    $requete->execute();
    return $requete->fetchAll($pdo_mode);
  }
  
  public function getRapportOperationnelCuivres($pdo_mode = PDO::FETCH_ASSOC){
    $requete = "call cuivres();";
    $requete = $this->pdo->prepare($requete);
    $requete->execute();
    return $requete->fetchAll($pdo_mode);
  }
  
  public function getRapportOperationnelAutres($pdo_mode = PDO::FETCH_ASSOC){
    $requete = "call autres();";
    $requete = $this->pdo->prepare($requete);
    $requete->execute();
    return $requete->fetchAll($pdo_mode);
  }

}
