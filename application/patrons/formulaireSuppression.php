<main class="_formulaire">
  <form method="post" id="formulaire" name="formulaire" action="<?php echo URL . 'suppression/recrutementSuppression'; ?>">
    <fieldset>
      <div class="ligne" id="_id">
	<input id="id" name="id" type="text" value="<?php echo $musicien['id']; ?>" readonly="readonly"/>
	<label for="id">Id</label>
      </div>
      <div class="ligne" id="_genre">
	<input id="genre" name="genre" type="text" value="<?php echo $musicien['genre']; ?>" readonly="readonly" />
	<label for="genre">Genre</label>
      </div>
      <div class="ligne" id="_nom">
	<input id="nom" name="nom" type="text"  value="<?php echo $musicien['nom']; ?>"  title="Information requise." readonly="readonly"/>
	<label for="Nom">Nom</label>
      </div>
      <div class="ligne" id="_prenom">
	<input id="prenom" name="prenom" type="text" value="<?php echo $musicien['prenom']; ?>" readonly="readonly"/>
	<label for="prenom">Prénom</label>
      </div>
      <div class="ligne" id="_naissance">
	<input id="naissance" name="naissance" type="text"  value="<?php echo $musicien['naissance']; ?>"  readonly="readonly"/>
	<label for="naissance">Date de naissance</label>
      </div>
      <div class="ligne" id="_ville">
	<input id="ville" name="ville" type="text" value="<?php echo $musicien['ville']; ?>"  title="" readonly="readonly"/>
	<label for="ville">Ville de naissance</label>
      </div>
      <div class="ligne" id="_courriel">
	<input id="courriel" name="courriel" type="text" value="<?php echo $musicien['courriel']; ?>"  title=""  readonly="readonly"/>
	<label for="courriel">Courriel</label>
      </div>
      <div class="ligne" id="_fonction">
	<input id="fonction" name="fonction" type="text" value="<?php echo $musicien['fonction']; ?>" readonly="readonly" />	
	<label for="fonction">Instrument</label>
      </div>
      <div class="ligne" id="_nationalite">
	<input id="nationalite" name="nationalite" type="text" value="<?php echo $musicien['pays']; ?>" readonly="readonly" />
	<label for="nationalite">Nationalité</label>
      </div>
      <div class="ligne" id="_submit"> 
	<input id="submit" name="<?php echo strtolower($libelle); ?>" type="submit" value="<?php echo ucfirst($libelle); ?>"/>
      </div>
    </fieldset>
  </form>
</main>
