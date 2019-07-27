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

  public function index0(array $envoi){

    echo $this->getEnteteHtml();
    echo $this->getBarreMenusHtml();

    echo '<main class="accueil">
    <p id="p1">Gestion de l’effectif d’un orchestre symphonique. Web-application de type CRUD. Toutes les opérations sont accesibles à partir des quatre menus principaux : <em>Lecture</em> pour consulter la base de données, <em>Création</em> pour recruter un musicien, <em>Modification</em> pour éditer les informations et finalement <em>Suppression</em>. Les informations sont présentées sous la forme de tableau. Il est possible de réordonner les données de chaque tableau en cliquant sur les entêtes.</p>

    <h1 id="t1">Orchestre</h1>
    
    <p id="p2">Seules les fonctionnalités essentielles sont implémentées. Neque laoreet suspendisse interdum consectetur libero, id faucibus nisl tincidunt eget nullam non nisi est, sit? Justo, laoreet sit amet cursus sit amet? Lacus, viverra vitae congue eu, consequat ac felis donec et odio pellentesque diam volutpat commodo sed egestas egestas. Diam maecenas ultricies mi eget mauris? Duis ut diam quam nulla porttitor massa id neque aliquam vestibulum morbi blandit cursus risus, at ultrices mi tempus imperdiet nulla malesuada pellentesque elit. Arcu ac tortor dignissim convallis aenean et tortor at?</p>

    <h1 id="t2">À faire</h1>

    <ul id="p3">
    <li>HTML5</li>
    <li>CSS3</li>
    <li>Javascript</li>
    <li>LAMP</li>
    <li>Apache Server</li>
    <li>MySQL</li>
    <li>PHP</li>
    <li>Debian</li>
    </ul>

    <h1 id="t3">Technologies utilisées</h1>
    </main>';

    //echo $this->getBilan();
    /* echo $this->getBasDePageHtml();     */
  }
  
}
