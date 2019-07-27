<?php

class Accueil {

  use Outils;

  private $dbase;
  
  private $methode;
  private $parametres;

  private $olv;
  private $genres;
  private $instruments;
  private $nationalites;

  
  public function __construct(BDonnees $dbase, OrchestreListeVues $olv,  string $methode, array $parametres){

    $this->dbase = $dbase;
    $this->methode = $methode;

    $this->olv = $olv;
    $this->genres = $this->dbase->getGenres();
    $this->instruments = $this->dbase->getInstruments();
    $this->nationalites = $this->dbase->getNationalites();

    $this->parametres = (count(array_filter($parametres)) !== 0) ? array_filter($parametres) : ['index'];
    $this->$methode($this->parametres);    
  }

  public function index(array $envoi){

    $rapport = array_merge(...$this->dbase->getRapportOperationnel());

    $nationalites = $this->dbase->getRapportOperationnelNationalites();

    $cordes = array_merge(...$this->dbase->getRapportOperationnelCordes());
    $bois = array_merge(...$this->dbase->getRapportOperationnelBois());
    $cuivres = array_merge(...$this->dbase->getRapportOperationnelCuivres());
    $autres = array_merge(...$this->dbase->getRapportOperationnelAutres());
    
    $pays = array_map(function($clef, $valeur){
      return '<tr><td>'.$clef.'</td><td>'.$valeur.'</td></tr>'.PHP_EOL ; }, array_keys($nationalites), array_values($nationalites)
    );
    
    $pays = implode(" ", $pays);

    $bilan = array_merge($rapport, $cordes, $bois, $cuivres, $autres, ['pays'=>$pays]);

    $message = $this->getMessage();

    echo $this->getEnteteHtml();
    echo $this->getBarreMenusHtml();

    /* if($message){
     *   echo '<div class="messagerie">';
     *   echo '<h1 id="succes">'.$message.'</h1>';
     *   echo '</div>';
     * } */

    echo $this->getBilan($bilan);
    echo $this->getScriptBilan();
    echo $this->getBasDePageHtml();
  }

  
}
