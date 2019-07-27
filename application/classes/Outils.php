<?php
trait Outils {

  // closure
  public function baliser(string $balise){
    return function(string $chaine) use($balise){
      return "<$balise>".$chaine."</$balise>";
    };
  }

  // public $baliseTD = baliser("td");
  

  public function redirection($lien='index'){
    header('location: ' . URL . '/' . $lien);
  }

  public function ucfirst_utf8(string $chaine){
    return mb_convert_case($chaine, MB_CASE_TITLE, "UTF-8");
  }

  public function correction(array $listeMots, array $dictionnaire){
    return array_map(function($mot)use($dictionnaire){
      return isset($dictionnaire[$mot]) ? $dictionnaire[$mot]: $mot;}
		   , $listeMots);
  }

  ///////////////////////////////////////////////////////////////
  // Outils php : validation
  ///////////////////////////////////////////////////////////////

  public function validationChaine($envoi){
    return empty($envoi) ? "" : filter_var(trim($envoi), FILTER_SANITIZE_STRING);
  }

  public function validationEntier($envoi){
    return empty($envoi) ? "" : filter_var($envoi, FILTER_VALIDATE_INT);
  }

  public function validationCourriel($courriel=""){
    return empty($courriel) ? "" : filter_var($courriel, FILTER_VALIDATE_EMAIL);
  }

  public function conversionNaissanceJJMMAAAA($jjmmaaaa=""){
    return empty($jjmmaaaa) ? null : date('Y-m-d', strtotime($jjmmaaaa));
  }

  public function conversionNaissanceAAAAMMJJ($aaaammjj=""){
    return empty($aaaammjj) ? null : date('d-m-Y', strtotime($aaaammjj));
  }

  ///////////////////////////////////////////////////////////////
  // Outils html
  ///////////////////////////////////////////////////////////////

  public function getEnteteHtml(){
    ob_start();
    include(PATRONS . 'enteteHtml.php');
    return ob_get_clean();
  }

  public function getBarreMenusHtml(){
    ob_start();
    include(PATRONS . 'barreMenusHtml.php');
    return ob_get_clean();
  }

  public function getBasDePageHtml(){
    ob_start();
    include(PATRONS . 'basDePageHtml.php');
    return ob_get_clean();
  }

  public function getScriptTableau(){
    ob_start();
    echo '<script src="' . URL . 'public/js/tableau.js">';
    echo '</script>';
    return ob_get_clean();
  }

  public function getScriptFormulaire(){
    ob_start();
    echo '<script src="' . URL . 'public/js/formulaire.js">';
    echo '</script>';
    return ob_get_clean();
  }

  public function getScriptBilan(){
    ob_start();
    echo '<script src="'. URL . 'public/js/bilan.js">';
    echo '</script>';
    return ob_get_clean();
  }

  public function getFormulaireCreation(array $genres, array $instruments, array $nationalites){
    ob_start();
    extract($genres);
    extract($instruments);
    extract($nationalites);
    include(PATRONS . 'formulaireCreation.php');
    return ob_get_clean();
  }

  public function getFormulaireMaj(array $musicien, array $genres, array $instruments, array $nationalites){
    ob_start();
    extract($musicien);
    extract($genres);
    extract($instruments);
    extract($nationalites);
    $libelle = 'modifier';
    include(PATRONS . 'formulaireModification.php');
    return ob_get_clean();
  }

  public function getFormulaireSup(array $musicien){
    ob_start();
    extract($musicien);
    $libelle = 'supprimer';    
    include(PATRONS . 'formulaireSuppression.php');
    return ob_get_clean();
  }

  public function getBilan(array $bilan){
    ob_start();
    extract($bilan);
    include(PATRONS . 'bilan.php');
    return ob_get_clean();
  }

  public function getTitrePanneau(array $intitule){
    $libelle = is_null($intitule['nombre']) || empty($intitule['nombre']) ? $intitule['texte'] : $intitule['texte']." : ".$intitule['nombre'];
    
    ob_start();
    echo '<h1 id="intitulePanneau">'.$libelle.'</h1>' . PHP_EOL;
    return ob_get_clean();
  }

  public function getHtmlTable($entete, $lignes){
    ob_start();
    echo '<div id="cadreTableau">' . PHP_EOL;
    echo '<table class="instrumentistes" id="tableau">' . PHP_EOL;
    echo "<thead>" . $entete . "</thead>" . PHP_EOL;
    echo "<tbody>" . PHP_EOL;
    echo implode("".PHP_EOL, $lignes);
    echo "</tbody>" . PHP_EOL;
    echo "</table>" . PHP_EOL;
    echo '</div>' . PHP_EOL;
    return ob_get_clean();
  }


  public function getHtmlTableEntetes(array $intitules, array $corriges, array $types){
    $entetes = array_combine(array_keys($intitules), array_values($corriges));
    $retour = array_map(function($clef, $valeur)use($types){
      return isset($types[$clef]) ?
	     '<th data-type="'.$types[$clef].'">'.$this->ucfirst_utf8($valeur).'</th>':
	     '<th data-type="inconnu">'.$this->ucfirst_utf8($valeur).'</th>';}
		      , array_keys($entetes), array_values($entetes));
    return  array_combine(array_keys($intitules), array_values($retour));
  }
  

  public function getHtmlTableLignes(array $donnees){
    $rangsHtml = function($musicien){
      return array_map(function($x){return "<td>".$x."</td>";}, $musicien);      
    };
    
    $lignes = function($musiciens)use($rangsHtml){
      return array_map($rangsHtml, $musiciens);
    };
    return $lignes($donnees);
  }

  public function getMessage(){
    $m = isset($_SESSION['musicien']) ? $_SESSION['musicien'] : null;
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
    unset($_SESSION['musicien']);
    unset($_SESSION['message']);
    
    if(null === $m || null === $message){
      return null;
    }
    
    $g = array_column($this->genres, 'civilite','sexe');
    $i = array_column($this->instruments, 'nomcomplet','nom');   
    $m['genre'] = isset($g[$m['genre']]) ? $this->ucfirst_utf8($g[$m['genre']]) : "";
    $m['fonction'] = isset($i[$m['fonction']]) ? $i[$m['fonction']] : "";
    $m['nom'] = isset($m['nom']) ? $this->ucfirst_utf8($m['nom']) : "";
    $m['prenom'] = $this->ucfirst_utf8($m['prenom']);
    
    $retour = array($m['genre'],  $m['nom'], $m['prenom'], $m['fonction']);
    return $message . " " . implode(" ", $retour);  
  }

  /**********************************************************/

  public function listeAccueil(int $numeroRequete=0){
    $retour = $this->dbase->lectureVue($numeroRequete);
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
    $message = $this->getMessage();
  }

}
