<main class="_formulaire">
  <!-- <main>
       <div id="_formulaire"> -->
    <form method="post" id="formulaire" name="formulaire" action="<?php echo URL . 'creation/recrutementCreation'; ?>">
      <fieldset>
	<div class="ligne" id="_genre">
	  <select id="genre" name="genre" size="1" title="Information requise." required>
	    <option value="">Genre</option>
	    <?php
	    $genreSexe='sexe';
	    $genreCivilite='civilite';
	    $retourGenres = array_map(function($x)use($genreSexe, $genreCivilite){return '<option value="'.$x[$genreSexe].'">'.ucfirst($x[$genreCivilite]).'</option>';}, $genres);
	    echo implode("", $retourGenres);
	    ?>
	    
	  </select>
	  <label for="genre">Genre</label>
	</div>
	<div class="ligne" id="_nom">
	  <input id="nom" name="nom" type="text" placeholder="" value=""  title="Information requise." required/>
	  <label for="Nom">Nom</label>
	</div>
	<div class="ligne" id="_prenom">
	  <input id="prenom" name="prenom" type="text" value="" />
	  <label for="prenom">Prénom</label>
	</div>
	<div class="ligne" id="_naissance">
	  <input id="naissance" name="naissance" type="text" title="JJ-MM-AAAA" value="" placeholder="JJ-MM-AAAA" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" minlength="10" maxlength="10" required/>
	  <label for="naissance">Date de naissance</label>
	</div>
	<div class="ligne" id="_ville">
	  <input id="ville" name="ville" type="text" value=""  title="" />
	  <label for="ville">Ville de naissance</label>
	</div>
	<div class="ligne" id="_courriel">
	  <input id="courriel" name="courriel" type="text" value=""  title="" pattern="[^ @]*@[^@]*" />
	  <label for="courriel">Courriel</label>
	</div>
	<div class="ligne" id="_fonction">
	  <select id="fonction" name="fonction" size="1"  title="Information requise." required>
	    <option value="">Instrument</option>
	    <?php
	    $groupes = array_unique(array_column($instruments, 'groupe'));
	    $retourInstruments = [];
	    foreach($groupes as $groupe){
	      $retourInstruments[] = '<optgroup label="'.ucfirst($groupe).'">'.PHP_EOL;
	      foreach($instruments as $instrument){
		if($instrument['groupe'] === $groupe){
		  $retourInstruments[] = '<option value="'.$instrument['nom'].'">'.$instrument['nomcomplet'].'</option>'.PHP_EOL;
		}
	      }
	      $retourInstruments[] = '</optgroup>'.PHP_EOL;
	    }
	    echo implode("", $retourInstruments);
	    ?>
	  </select>
	  <label for="fonction">Instrument</label>
	</div>
	<div class="ligne" id="_nationalite">
	  <select  id="nationalite" name="nationalite" size="1"  title="Pays dont le musicien est un ressortissant." required> 
	    <option value="">Nationalité</option>
	    <?php
	    $zones = array_unique(array_column($nationalites, 'zone_geographique'));
	    $retourNationalites = [];
	    foreach($zones as $zone){
	      $retourNationalites[] = '<optgroup label="'.ucwords($zone).'">'.PHP_EOL;
	      foreach($nationalites as $pays){
		if($pays['zone_geographique'] === $zone){
		  $retourNationalites[] = '<option value="'.$pays['iso'].'">'.$pays['nom'].'</option>'.PHP_EOL;
		}
		
	      }
	      $retourNationalites[] = '</optgroup>'.PHP_EOL;
	    }
	    echo implode("", $retourNationalites);
	    ?>
	  </select>
	  <label for="nationalite">Nationalité</label>
	</div>
	<div class="ligne" id="_submit"> 
		  <input id="submit" name="enregistrer" type="submit" value="Enregistrer"/>
		</div>
      </fieldset>
    </form>
    <!-- </div>
	 </main> -->
</main>
<script src="<?php echo URL . 'public/js/orchestre.js'; ?>">
</script>
</body>
     </html>
