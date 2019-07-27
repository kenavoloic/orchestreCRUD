document.addEventListener('DOMContentLoaded', () => {
  initialisations();
});

function initialisations(){

  /* Champs du formulaire  */
  const genre = document.getElementById('genre');
  const nom = document.getElementById('nom');
  const prenom = document.getElementById('prenom');
  const instrument = document.getElementById('instrument');
  const nationalite = document.getElementById('nationalite');
  const anniversaire = document.getElementById('anniversaire');

  /* <select> */
  genre.addEventListener('onchange', () => {
    genre.setCustomValidity('');
    genre.checkValidity();
  });

  genre.addEventListener('invalid', () => {
    if(genre.value === ''){
      genre.setCustomValidity('Merci de renseigner le genre.');
    } else 
    genre.setCustomValidity('');
  });

  instrument.addEventListener('onchange', () =>{
    instrument.setCustomValidity('Merci d’indiquer l’instrument.');
    instrument.checkValidity();
  });

  instrument.addEventListener('invalid', () => {
    if(instrument.value === ''){
      instrument.setCustomValidity('Merci d’indiquer le nom de l’instrument.');
    } else {
      instrument.setCustomValidity('');
    }
  });

  nationalite.addEventListener('onchange', () => {
    nationalite.setCustomValidity('');
    nationalite.checkValidity();
  });

  nationalite.addEventListener('invalid', () => {
    if(nationalite.value === ''){
      nationalite.setCustomValidity('Merci de choisir le pays d’origine.');
    } else {
      nationalite.setCustomValidity('');
    }
  });

  /* Champs de texte */
  nom.addEventListener('input', () => {
    nom.setCustomValidity('');
    nom.checkValidity();
  });

  nom.addEventListener('invalid', () => {
    if(nom.value === ''){
      nom.setCustomValidity('Merci d’entrez un nom.');
    }      
  });

  prenom.addEventListener('input', () => {
    prenom.setCustomValidity('');
    prenom.checkValidity();
  });

  prenom.addEventListener('invalid', () => {
    if(prenom.value === ''){
      prenom.setCustomValidity('Entrez un prénom.');
    }
  });

  /* Pas nécessaire d’utiliser l'objet <input type="date">, son interface va changer en fonction du navigateur ou de l'os du client. Total contrôle avec le champs de texte. */

  /* Il suffira côté serveur de transformer la chaîne "jj/mm/aaaa" en "aaaa/mm/jj". C'est ainsi qu'elle sera stockée dans la dBase. */

  anniversaire.addEventListener('input', () => {
    anniversaire.setCustomValidity('');
    anniversaire.checkValidity();
  });

  anniversaire.addEventListener('invalid', () => {
    anniversaire.setCustomValidity('Merci de formater la date ainsi : jj-mm-aaaa.');	
  });

  
}
