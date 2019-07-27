<main class="bilan">
  <section id="titre">
    <h2>Effectif opérationnel</h2>
  </section>
  <section id="musiciens">
    <h2>Musiciens</h2>
    <table class="instrumentistes">
      <thead><tr><th data-type="entier">Nombre</th></tr></thead>
      <tbody><tr><td><?php echo $bilan['nombre']; ?></td></tr></tbody>
    </table>
  </section>
  <section id="genres">
    <table class="instrumentistes">
      <h2>Genres</h2>
      <thead>
	<tr><th data-type="chaine">Genre</th><th data-type="entier">Nombre</th></tr>
      </thead>
      <tbody>
	<tr><td>Femme</td><td><?php echo $bilan['femmes']; ?></td></tr>
	<tr><td>Homme</td><td><?php echo $bilan['hommes']; ?></td></tr>
      </tbody>
    </table>
  </section>
  <section id="direction">
    <h2>Direction</h2>
    <table class="instrumentistes">
      <thead>
	<tr><th data-type="fonction">Instrument</th><th data-type="entier">Nombre</th></tr>
      </thead>
      <tbody>
	<td>Chef</td><td><?php echo $bilan['direction']; ?></td>
      </tbody>	  
    </table>
  </section>
  <section id="cordes">
    <h2>Cordes</h2>
    <table class="instrumentistes">
      <thead>
	<tr><th data-type="fonction">Instrument</th><th data-type="entier">Nombre</th></tr>
      </thead>
      <tbody>
	<tr><td>Premier violon</td><td><?php echo $bilan['v1']; ?></td></tr>
	<tr><td>Second violon</td><td><?php echo $bilan['v2']; ?></td></tr>
	<tr><td>Alto</td><td><?php echo $bilan['alto']; ?></td></tr>
	<tr><td>Violoncelle</td><td><?php echo $bilan['vlc']; ?></td></tr>
	<tr><td>Contrebasse</td><td><?php echo $bilan['cb']; ?></td></tr>
      </tbody>
    </table>
  </section>
  <section id="bois">
    <table class="instrumentistes">
      <h2>Bois</h2>
      <thead>
	<tr><th data-type="fonction">Instrument</th><th data-type="entier">Nombre</th></tr>
      </thead>
      <tbody>
	<tr><td>Piccolo</td><td><?php echo $bilan['picc']; ?></td></tr>
	<tr><td>Flûte traversière</td><td><?php echo $bilan['fl']; ?></td></tr>
	<tr><td>Hautbois</td><td><?php echo $bilan['htb']; ?></td></tr>
	<tr><td>Cor anglais</td><td><?php echo $bilan['coranglais']; ?></td></tr>
	<tr><td>Petite clarinette</td><td><?php echo $bilan['clarmi']; ?></td></tr>
	<tr><td>Grande clarinette</td><td><?php echo $bilan['clarsi']; ?></td></tr>
	<tr><td>Clarinette basse</td><td><?php echo $bilan['clarb']; ?></td></tr>
	<tr><td>Basson</td><td><?php echo $bilan['bsn']; ?></td></tr>
	<tr><td>Contrebasson</td><td><?php echo $bilan['cbsn']; ?></td></tr>
	<tr><td>Saxophone</td><td><?php echo $bilan['sax']; ?></td></tr>
      </tbody>
    </table>
  </section>
  <section id="cuivres">
    <table class="instrumentistes">
      <h2>Cuivres</h2>
      <thead>
	<tr><th data-type="fonction">Instrument</th><th data-type="entier">Nombre</th></tr>
      </thead>
      <tbody>
	<tr><td>Trompette</td><td><?php echo $bilan['trp']; ?></td></tr>
	<tr><td>Cor d’harmonie</td><td><?php echo $bilan['corharmonie']; ?></td></tr>
	<tr><td>Trombone</td><td><?php echo $bilan['trb']; ?></td></tr>
	<tr><td>Tuba</td><td><?php echo $bilan['tub']; ?></td></tr>
      </tbody>
    </table>
  </section>
  <section id="autres">
    <table class="instrumentistes">
      <h2>Autres</h2>
      <thead>
	<tr><th data-type="fonction">Instrument</th><th data-type="entier">Nombre</th></tr>
      </thead>
      <tbody>
	<tr><td>Timbales</td><td><?php echo $bilan['timb']; ?></td></tr>
	<tr><td>Percussions</td><td><?php echo $bilan['perc']; ?></td></tr>
	<tr><td>Harpe</td><td><?php echo $bilan['hp']; ?></td></tr>
	<tr><td>Claviers</td><td><?php echo $bilan['claviers']; ?></td></tr>
      </tbody>
    </table>
  </section>
  <section id="nationalites">	
    <table class="instrumentistes">
      <h2>Nationalités</h2>
      <thead>
	<tr><th data-type="chaine">Pays</th><th data-type="entier">Nombre</th></tr>
      </thead>
      <tbody>
	<?php echo $bilan['pays']; ?>
      </tbody>
    </table>	
  </section>
</main>
