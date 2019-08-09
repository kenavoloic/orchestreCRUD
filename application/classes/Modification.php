<?php

class Modification {

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

  public function maj(array $envoi){
    $nombre = $envoi[0];
    
    $musicien = $this->dbase->lectureModification($nombre);
    
    $nationalites = array_column($this->dbase->getNationalites(),'nom','iso');
    
    $musicien['nationalite'] = $nationalites[$musicien['iso']];
    $musicien['nom'] = $this->ucfirst_utf8($musicien['nom']);
    $musicien['prenom'] = $this->ucfirst_utf8($musicien['prenom']);
    $musicien['ville'] = $this->ucfirst_utf8($musicien['ville']);
    
    echo $this->getEnteteHtml();
    echo $this->getBarreMenusHtml();
    echo $this->getFormulaireMaj($musicien, $this->genres, $this->instruments, $this->nationalites);
    echo $this->getScriptFormulaire();
    echo $this->getBasDePageHtml();

  }

  
  public function fonction(array $envoi){

    $numeroRequete = $envoi[0] ?? 0;    

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
    
    $_titres = $donnees[0];
    $_titres['modification'] = 'modification';

    $th = $this->getHtmlTableEntetes($_titres, $this->correction(array_keys($_titres), $this->dictionnaire), $this->types);
    $colonnes_html = "<tr>".implode("", $th)."</tr>";

    $lien = 'modification/maj/';    
    $modificationRequise = "Mise à jour";

    foreach($donnees as &$musicien){
      $musicien['modification'] = '<a href="' . URL . $lien . $musicien['id'] . '">' . $modificationRequise . '</a>';      
    }

    $lignes = $this->getHtmlTableLignes($donnees);
    $lignes = array_map(function($x){return '<tr data-type="ligne">'.implode("",$x).'</tr>';}, $lignes);    
    $tableau = $this->getHtmlTable($colonnes_html, $lignes);

    $this->affichage($intitule, $tableau);
  }

  public function groupe(array $envoi){

    $numeroRequete = $envoi[0] ?? 0;    

    $numeroRequete = ($this->validationNumeroRequete)($numeroRequete);
    $retour = $this->dbase->lectureVueGroupe($numeroRequete);

    if (empty($retour['donnees'])){
      $this->vacance($retour, 'groupe');
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

    $lien = 'modification/maj/';    
    $modificationRequise = "Mise à jour";
    
    foreach($donnees as &$musicien){
      $musicien['modification'] = '<a href="' . URL . $lien . $musicien['id'] . '">' . $modificationRequise . '</a>';      
    }

    $lignes = $this->getHtmlTableLignes($donnees);
    $lignes = array_map(function($x){return '<tr data-type="ligne">'.implode("",$x).'</tr>';}, $lignes);    
    $tableau = $this->getHtmlTable($colonnes_html, $lignes);

    $this->affichage($intitule, $tableau);
    
  }


  public function recrutementModification($envois){
    $test = $_SERVER['REQUEST_METHOD'] === 'POST' ? TRUE : FALSE;

    if($test === false){
      $this->redirection('accueil');
    }
    
    $envoi = $_POST;

    $musicien = array_filter($envoi, function($x){return $x !== 'Modifier'; });
    $numeroID = $musicien['id'];


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

    $_SESSION['musicien'] = array(
      'genre' => $musicien['genre'],
      'nom' => $musicien['nom'],
      'prenom' => $musicien['prenom'],
      'fonction' => $musicien['fonction']
    );

    /* if(isset($musicien['genre'], $musicien['nom'], $musicien['naissance'], $musicien['fonction'], $musicien['nationalite'], $musicien['recrutement'])){ */
    
    if(isset($musicien['genre'], $musicien['nom'], $musicien['naissance'], $musicien['fonction'], $musicien['nationalite'], $musicien['recrutement'])){
      $test = false;
      $this->dbase->mise_a_jour($numeroID, $musicien);
      $musicien = array_filter($musicien);
      
      $_SESSION['musicien'] = $musicien;
      $_SESSION['message'] = "Modification de ";

      $this->redirection('modification/fonction/1');
    } else {
      $this->redirection('accueil');
    }    

  }

  private function vacance(array $envoi, string $type){
    $texte = array(
      'fonction' => 'Modification impossible. Aucun musicien n’assure cette fonction dans l’effectif opérationnel actuel.',
      'groupe' => 'Modification impossible. Sans recrutement d’instrumentistes, il ne sea par possible d’exécuter certaine œuvre du répertoire symphonique.'
    );

    $intitule = $envoi['intitule'];
    $annonce = ($type == 'fonction') ? $texte['fonction'] : $texte['groupe'];
    echo $this->getEnteteHtml();
    echo $this->getBarreMenusHtml();
    echo '<main class="tabulaire">'.PHP_EOL;
    echo '<table class="instrumentistes"><tr><th>'.$intitule.'</th></tr>'.PHP_EOL;
    echo '<tr><td class="texte">'.$annonce.'</td></tr>'.PHP_EOL;
    echo '</table>'.PHP_EOL;
    echo '</main>'.PHP_EOL;
    echo $this->getBasDePageHtml();
    
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
  

  public function index(array $envoi){
    $this->redirection('modification/fonction/1');
  }


}
