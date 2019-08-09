<?php

class Lecture {

  use Outils;
  
  private $dbase;

  private $methode;
  private $parametres;
  private $requete;
  private $olv;

  private $listeFonctionsOrchestrales;
  private $listeRequetesSQL;

  private $validationNumeroRequete;

  private $dictionnaire;
  private $types;
  private $casse;

  private $genres;
  private $instruments;
  private $nationalites;
  
  public function __construct(BDonnees $dbase, OrchestreListeVues $olv, string $methode, array $parametres){
    $this->dbase = $dbase;
    
    $this->olv = $olv;
    $this->listeFonctionsOrchestrales = $this->olv->getListeFonctionsOrchestrales();
    $this->listeRequetesSQL = $this->olv->getlisteRequetesSQL();
    $this->dictionnaire = $this->olv->getDictionnaire();
    $this->types = $this->olv->getAttributsDonnees();
    $this->casse = $this->olv->getCasse();

    $this->genres = $this->dbase->getGenres();
    $this->instruments = $this->dbase->getInstruments();
    $this->nationalites = $this->dbase->getNationalites();
    
    $this->methode  = $methode;
    $this->parametres = (count(array_filter($parametres)) !==0) ? array_filter($parametres) : [0];
    
    $this->validationNumeroRequete = function(int $nombre){
      return  $nombre > count($this->listeFonctionsOrchestrales) ? 0 : $nombre;
    };

    $this->$methode($this->parametres);
  }

  public function fonction(array $envoi){
    $numeroRequete = $envoi[0];
    $numeroRequete = ($this->validationNumeroRequete)($numeroRequete);
    $retour = $this->dbase->lectureVue($numeroRequete);

    if (empty($retour['donnees'])){
      $this->vacance($retour,'fonction');
      return null;
    }

    $donnees = $retour['donnees'];
    $intitule['texte'] = $retour['intitule'];
    $intitule['nombre'] = count(array_keys($donnees));

    $casse = $this->casse;    
    array_walk_recursive($donnees, function(&$valeur, $clef) use($casse){
      return $valeur = in_array($clef, $casse) ? mb_convert_case($valeur, MB_CASE_TITLE, "UTF-8") : $valeur;
    });

    $th = $this->getHtmlTableEntetes($donnees[0], $this->correction(array_keys($donnees[0]), $this->dictionnaire), $this->types);
    $colonnes_html = "<tr>".implode("", $th)."</tr>";
    $lignes = $this->getHtmlTableLignes($donnees);

    $lignes = array_map(function($x){return '<tr data-type="ligne">'.implode("",$x).'</tr>';}, $lignes);    
    $tableau = $this->getHtmlTable($colonnes_html, $lignes);

    $this->affichage($intitule, $tableau);
  }

  public function groupe(array $envoi){
    $numeroRequete = $envoi[0];
    $numeroRequete = ($this->validationNumeroRequete)($numeroRequete);
    $retour = $this->dbase->lectureVueGroupe($numeroRequete);
    
    if (empty($retour['donnees'])){
      $this->vacance($retour,'groupe');
      return null;
    }
    
    $donnees = $retour['donnees'];
    $intitule['texte'] = $retour['intitule'];
    $intitule['nombre'] = count(array_keys($donnees));

    $casse = $this->casse;    
    array_walk_recursive($donnees, function(&$valeur, $clef) use($casse){
      return $valeur = in_array($clef, $casse) ? mb_convert_case($valeur, MB_CASE_TITLE, "UTF-8") : $valeur;
    });

    $th = $this->getHtmlTableEntetes($donnees[0], $this->correction(array_keys($donnees[0]), $this->dictionnaire), $this->types);
    $colonnes_html = "<tr>".implode("", $th)."</tr>";

    $lignes = $this->getHtmlTableLignes($donnees);

    $lignes = array_map(function($x){return '<tr data-type="ligne">'.implode("",$x).'</tr>';}, $lignes);    
    $tableau = $this->getHtmlTable($colonnes_html, $lignes);

    $this->affichage($intitule, $tableau);
  }
  

  public function index(array $envoi){
    $this->redirection('lecture/fonction/1');
  }

  private function affichage(array $intitule, string $tableau){
    $message = $this->getMessage();
    echo $this->getEnteteHtml();
    echo $this->getBarreMenusHtml();
    echo '<main class="tabulaire">';
    if($message){
      echo '<div class="messagerie">';
      echo '<h1 id="succes">'.$message.'</h1>';
      echo '</div>';
    }
    echo '<div class="messagerie">';
    echo $this->getTitrePanneau($intitule);
    echo '</div>';
    echo '<div class="panneau">';
    echo $tableau;
    echo '</div>';
    echo '</main>';
    echo $this->getScriptTableau();
    echo $this->getBasDePageHtml();
  }

  private function vacance(array $envoi, string $type){
    $texte = array(
      'fonction' => 'Aucun musicien n’assure cette fonction dans l’effectif opérationnel. Impossible d’exécuter certaines œuvres du répertoire symphonique.',
      'groupe' => 'Impossible d’exécuter certaine œuvre du répertoire symphonique si vous ne recrutez pas des musiciens pour assurer ces fonctions instrumentales.'
    );
    
    $intitule = $envoi['intitule'];
    $annonce = ($type == 'fonction') ? $texte['fonction'] : $texte['groupe'];
    echo $this->getEnteteHtml();
    echo $this->getBarreMenusHtml();
    echo '<main class="tabulaire">'.PHP_EOL;
    echo '<table class="instrumentistes"><tr><th class="intitule">'.$intitule.'</th></tr>'.PHP_EOL;
    echo '<tr><td class="texte">'.$annonce.'</td></tr>'.PHP_EOL;
    echo '</table>'.PHP_EOL;
    echo '</main>'.PHP_EOL;
    echo $this->getBasDePageHtml();
  }
}
