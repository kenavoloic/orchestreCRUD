<?php

class Suppression {

  use Outils;
  
  private $dbase;

  private $olv;
  private $dictionnaire;
  private $types;
  private $casse;

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
    $this->casse = $this->olv->getCasse();

    $this->validationNumeroRequete = function(int $nombre){
      return $nombre > count($this->listeFonctionsOrchestrales) ? 0 : $nombre;
    };
    
    $this->$methode($this->parametres);
  }


  public function sup(array $envoi){
    $nombre = $envoi[0];
    $musicien = $this->dbase->lectureID($nombre);    

    $genre = array_column($this->genres, 'civilite','sexe');
    $genre = $genre[$musicien['genre']];
    $musicien['genre'] = $genre;
    
    $fonction = $musicien['fonction'];
    $musicien = array_map(function($x){return mb_convert_case($x, MB_CASE_TITLE, "UTF-8");}, $musicien);
    $musicien['courriel'] = strtolower($musicien['courriel']);
    $musicien['fonction'] = $fonction;

    echo $this->getEnteteHtml();
    echo $this->getBarreMenusHtml();
    echo $this->getFormulaireSup($musicien);
    echo $this->getScriptFormulaire();
    echo $this->getBasDePageHtml();
    
  }
  
  public function fonction(array $envoi){

    $numeroRequete = $envoi[0] ?? 0;    

    $numeroRequete = ($this->validationNumeroRequete)($numeroRequete);
    $retour = $this->dbase->lectureVue($numeroRequete);
    
    if (empty($retour['donnees'])){
      $this->fonctionVacante($retour);
      return null;
    }

    $donnees = $retour['donnees'];
    $intitule['texte'] = $retour['intitule'];
    $intitule['nombre'] = count(array_keys($donnees));
    
    $casse = $this->casse;
    array_walk_recursive($donnees, function(&$valeur, $clef) use($casse){
      return $valeur = in_array($clef, $casse) ? mb_convert_case($valeur, MB_CASE_TITLE, "UTF-8") : $valeur;
    });
    
    $_titres = $donnees[0];
    $_titres['suppression'] = 'suppression';

    $th = $this->getHtmlTableEntetes($_titres, $this->correction(array_keys($_titres), $this->dictionnaire), $this->types);
    $colonnes_html = "<tr>".implode("", $th)."</tr>";

    $lien = 'suppression/sup/';    
    $modificationRequise = "Suppression";

    foreach($donnees as &$musicien){
      $musicien['suppression'] = '<a href="' . URL . $lien . $musicien['id'] . '">' . $modificationRequise . '</a>';      
    }

    $lignes = $this->getHtmlTableLignes($donnees);
    $lignes = array_map(function($x){return '<tr data-type="ligne">'.implode("",$x).'</tr>';}, $lignes);    
    $tableau = $this->getHtmlTable($colonnes_html, $lignes);

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

  public function groupe(array $envoi){

    $numeroRequete = $envoi[0] ?? 0;    

    $numeroRequete = ($this->validationNumeroRequete)($numeroRequete);
    $retour = $this->dbase->lectureVueGroupe($numeroRequete);

    if (empty($retour['donnees'])){
      $this->groupeVacant($retour);
      return null;
    }

    $donnees = $retour['donnees'];
    $intitule['texte'] = $retour['intitule'];
    $intitule['nombre'] = count(array_keys($donnees));

    $casse = $this->casse;
    array_walk_recursive($donnees, function(&$valeur, $clef) use($casse){
      return $valeur = in_array($clef, $casse) ? mb_convert_case($valeur, MB_CASE_TITLE, "UTF-8") : $valeur;
    });
    
    
    $_titres = $donnees[0];
    $_titres['modification'] = 'modification';

    $th = $this->getHtmlTableEntetes($_titres, $this->correction(array_keys($_titres), $this->dictionnaire), $this->types);
    $colonnes_html = "<tr>".implode("", $th)."</tr>";
    $lien = 'suppression/sup/';    
    $modificationRequise = "Suppression";
    
    foreach($donnees as &$musicien){
      $musicien['suppression'] = '<a href="' . URL . $lien . $musicien['id'] . '">' . $modificationRequise . '</a>';      
    }

    $lignes = $this->getHtmlTableLignes($donnees);
    $lignes = array_map(function($x){return '<tr data-type="ligne">'.implode("",$x).'</tr>';}, $lignes);    
    $tableau = $this->getHtmlTable($colonnes_html, $lignes);

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

  public function recrutementSuppression(){
    $testPRG = $_SERVER['REQUEST_METHOD'] === 'POST' ? TRUE : FALSE;
    $envoi = $_POST;

    $retour = array_filter($envoi, function($x){return $x !== 'Supprimer'; });
    
    $id = $retour['id'];
    
    if($testPRG){
      
      $testPRG = false;
      $musicien = $this->dbase->lectureID($id);
      $this->dbase->suppression($id);      
      
      $retour = array_filter($retour);
      
      $_SESSION['musicien'] = $musicien;
      $_SESSION['message'] = "Suppression de ";

      $this->redirection('index.php');
    } else {
      $this->redirection('suppression/fonction/1');
    }
  }

  private function fonctionVacante(array $envoi){
    $intitule = $envoi['intitule'];
    echo $this->getEnteteHtml();
    echo $this->getBarreMenusHtml();
    echo '<main class="tabulaire">'.PHP_EOL;
    echo '<table class="instrumentistes"><tr><th>'.$intitule.'</th></tr>'.PHP_EOL;
    echo '<tr><td class="texte">Suppression impossible. Aucun musicien n’assure cette fonction dans l’effectif actuel.</td></tr>'.PHP_EOL;
    echo '</table>'.PHP_EOL;
    echo '</main>'.PHP_EOL;
    echo $this->getBasDePageHtml();
  }
  
  private function groupeVacant(array $envoi){
    $intitule = $envoi['intitule'];
    echo $this->getEnteteHtml();
    echo $this->getBarreMenusHtml();
    echo '<main class="tabulaire">'.PHP_EOL;
    echo '<table class="instrumentistes"><tr><th>'.$intitule.'</th></tr>'.PHP_EOL;
    echo '<tr><td class="texte">Suppression impossible. Il est au contraire nécessaire de recruter des musiciens.</td></tr>'.PHP_EOL;
    echo '</table>'.PHP_EOL;
    echo '</main>'.PHP_EOL;
    echo $this->getBasDePageHtml();
  }

}
