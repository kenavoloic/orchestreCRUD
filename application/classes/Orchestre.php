<?php

class Orchestre {

  private $controleur;
  private $methode;
  private $parametres;
  private $pdo = null;

  private $olv;
  private $whitelist; 
  
  public function __construct(array $configurationDbase){

    $this->olv = new OrchestreListeVues();
    $this->pdo = $this->getPdo($configurationDbase, $this->olv);

    $this->whitelist = $this->olv->getWhitelist();
    
    $retour =  $this->getControleurMethodeParametres();
    $this->controleur = $retour[0];
    $this->methode = $retour[1];
    $this->parametres = $retour[2];

    $nomClasse = ucfirst($this->controleur);
    $nouvelleInstance = new $nomClasse($this->pdo, $this->olv, $this->methode, $this->parametres);
  }

  private function getPdo(array $configurations, OrchestreListeVues $olv){
    $dbase = new BDonnees($configurations, $olv);
    return $dbase;
  }

  public function  getControleurMethodeParametres(){
    $uri = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
    
    $index = $_SERVER['SCRIPT_NAME'];

    $requete = explode('/', strtolower($uri));
    $requete = array_diff($requete, array('',$index));
    $requete = array_values($requete);
    
    $controleur = isset($requete[0]) ? $requete[0]: 'accueil';
    $methode = isset($requete[1]) ? $requete[1] : 'index';
    unset($requete[0], $requete[1]);
    $requete = array_filter($requete);
    $parametres = (count($requete) === 0) ? [] : array_values($requete);

    if($controleur !== 'accueil'){
      $controleur = array_key_exists($controleur, $this->whitelist) ? $controleur : 'accueil';
      $methode = method_exists(ucfirst($controleur), $methode) ? $methode : 'index';
    }
    
    $_SESSION['controleur'] = $controleur;
    $_SESSION['methode'] = $methode;
    $_SESSION['parametres'] = $parametres;

    return array($controleur, $methode, $parametres);    
  }

}
