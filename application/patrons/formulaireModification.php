<main class="_formulaire">
  <form method="post" id="formulaire" name="formulaire" action="<?php echo URL . 'modification/recrutementModification'; ?>">
    <fieldset>
      <div class="ligne" id="_id">
	<input id="id" name="id" type="text" value="<?php echo $musicien['id']; ?>" readonly="readonly" />
	<label for="id">Id</label>
      </div>
      <div class="ligne" id="_genre">
	<select id="genre" name="genre" size="1" title="Information requise." required>
	  <?php
	  $genreChoix = $musicien['genre'];
	  $genreSexe = 'sexe';
	  $genreCivilite = 'civilite';
	  $retourGenres = array_map(function($x) use($genreChoix, $genreSexe, $genreCivilite){
	    return $x[$genreSexe] === $genreChoix ?
		   '<option value="' .$x[$genreSexe] . '" selected' . '>' . ucfirst($x[$genreCivilite]). '</option>'
		  :'<option value="' .$x[$genreSexe] . '">'.ucfirst($x[$genreCivilite]).'</option>'
	    ;}, $genres);
	  echo implode("", $retourGenres);
	  ?>
	</select>
	<label for="genre">Genre</label>
      </div>
      <div class="ligne" id="_nom">
	<input id="nom" name="nom" type="text" placeholder="" value="<?php echo $musicien['nom']; ?>"  title="Information requise." required/>
	<label for="Nom">Nom</label>
      </div>
      <div class="ligne" id="_prenom">
	<input id="prenom" name="prenom" type="text" value="<?php echo $musicien['prenom']; ?>" />
	<label for="prenom">Prénom</label>
      </div>
      <div class="ligne" id="_naissance">
	<input id="naissance" name="naissance" type="text" title="JJ-MM-AAAA" value="<?php echo $musicien['naissance']; ?>" placeholder="JJ-MM-AAAA" pattern="[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}" minlength="10" maxlength="10" />
	<label for="naissance">Date de naissance</label>
      </div>
      <div class="ligne" id="_ville">
	<input id="ville" name="ville" type="text" value="<?php echo $musicien['ville']; ?>"  title="" />
	<label for="ville">Ville de naissance</label>
      </div>
      <div class="ligne" id="_courriel">
	<input id="courriel" name="courriel" type="text" value="<?php echo $musicien['courriel']; ?>"  title="" pattern="[^ @]*@[^@]*" />
	<label for="courriel">Courriel</label>
      </div>
      <div class="ligne" id="_fonction">
	<select id="fonction" name="fonction" size="1"  title="Information requise." required>
	  <?php
	  $instrumentChoix = $musicien['fonction'];
	  $groupes = array_unique(array_column($instruments, 'groupe'));
	  $instrumentsNoms = array_column($instruments, 'nomcomplet','nom');

	  $retourInstruments = [];
	  
	  foreach($groupes as $groupe){
	    $retourInstruments[] = '<optgroup label="' . ucfirst($groupe) . '">' . PHP_EOL;
	    foreach($instruments as $instrument){
	      if ($instrument['groupe'] === $groupe){
		if($instrument['nom'] === $instrumentChoix){
		  $retourInstruments[] = '<option value="' .$instrument['nom'] . '" selected>' . $instrument['nomcomplet'].'</option>'. PHP_EOL;
		  continue;
		}
		$retourInstruments[] = '<option value="'.$instrument['nom'].'">'.$instrument['nomcomplet'].'</option>' . PHP_EOL;
	      }
	    }
	    $retourInstruments[] = '</optgroup>' . PHP_EOL;
	  }	  
	  echo implode("", $retourInstruments);	  
	  ?>	  
	</select>
	<label for="fonction">Instrument</label>
      </div>
      <div class="ligne" id="_nationalite">
	<select  id="nationalite" name="nationalite" size="1"  title="Pays dont le musicien est un ressortissant." required> 
	  <?php
	  $zones = array_unique(array_column($nationalites, 'zone_geographique'));
	  $retour =[];
	  $retourNationalites = [];
	  foreach($zones as $zone){
	    $retour[] = '<optgroup label="' . $zone . '">'  . PHP_EOL;
	    foreach($nationalites as $pays){
	      if($pays['zone_geographique'] === $zone){
		$pais = ($musicien['iso'] === $pays['iso']) ? '<option value="'.$pays['iso'].'" selected>'.$pays['nom'].'</option>' : '<option value="'.$pays['iso'].'">'.$pays['nom'].'</option>';
		$retour[] = $pais . PHP_EOL;
	      }
	    }
	    $retour[] = '</optgroup>' . PHP_EOL;
	  }
	  echo implode("",$retour);
	  ?>
	</select>
		<label for="nationalite">Nationalité</label>
                  </div>
		  <div class="ligne" id="_recrutement">
		    <input id="recrutement" name="recrutement" type="text" title="JJ-MM-AAAA" value="<?php echo $musicien['recrutement']; ?>" placeholder="JJ-MM-AAAA" pattern="[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}" minlength="10" maxlength="10" />
		    <label for="recrutement">Date de recrutement</label>
		  </div>
      <div class="ligne" id="_submit"> 
	<input id="submit" name="<?php echo strtolower($libelle) ; ?>" type="submit" value="<?php echo ucfirst($libelle); ?>"/>	
      </div>
    </fieldset>
  </form>
</main>
