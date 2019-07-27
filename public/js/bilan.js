// https://github.com/GregoryVigoTorres/sortableTables

function Matrice(){
  this.totaliteLignes = [];
  this.entetes = [];
  this.triEffectue = {};
}

Matrice.prototype.initialisation = function(){
  this.totaliteLignes = Array.from(this.matrice.querySelectorAll('tbody > tr'));  
  this.entetes = Array.from(this.matrice.querySelectorAll('tr th'));
  this.entetes.map(th => th.addEventListener('click', this.getColonne.bind(this)));
};

Matrice.prototype.remplaceLignes = function(lignes, index){

  if(this.triEffectue[index]){
    lignes = lignes.reverse();
    this.triEffectue[index] = undefined;
  } else {
    this.triEffectue[index] = true;
  }

  this.totaliteLignes.forEach(function(item){item.remove();});

  let corps = this.matrice.getElementsByTagName('tbody')[0];
  
  for(let i=0;i<lignes.length;i++){
    corps.appendChild(lignes[i]);
  };
  
};

Matrice.prototype.getColonne = function(evenement){
  let origine = evenement.target;
  let index = this.entetes.indexOf(origine);
  let typeDonnee = origine.getAttribute('data-type');
  
  switch(typeDonnee){
    case 'chaine':
      this.triChaine(index);
      break;
    case 'entier':
      this.triEntier(index);
      break;
    case 'date':
      this.triDate(index);
      break;
    case 'groupe':
      this.triGroupe(index);
      break;
    case 'fonction':
      this.triFonction(index);
      break;
    default:
      this.triChaine(index);
      break;      
  }
};

// Algo de tri : chaine, groupe, fonction, entier, date
Matrice.prototype.triChaine = function(index){
  let lignes = this.totaliteLignes;  
  lignes.sort(function(x,y){
    let cx = String(x.children[index].textContent.trim());
    let cy = String(y.children[index].textContent.trim());
    return cx.localeCompare(cy);
  });
  this.remplaceLignes(lignes, index);
};

Matrice.prototype.triGroupe = function(index){
  let ordre = ['Direction','Cordes','Bois','Cuivres','Autres'];
  let lignes = this.totaliteLignes;
  lignes.sort(function(x,y){
    let cx = String(x.children[index].textContent.trim());
    let cy = String(y.children[index].textContent.trim());
    return ordre.indexOf(cx) - ordre.indexOf(cy);
  });
  this.remplaceLignes(lignes, index);  
};

Matrice.prototype.triFonction = function(index){
  let ordre = ["Chef d’orchestre", "Premier violon", "Second violon", "Alto", "Violoncelle", "Contrebasse", "Piccolo", "Flûte traversière", "Hautbois", "Cor anglais", "Petite clarinette", "Grande clarinette", "Clarinette basse", "Basson", "Contrebasson", "Saxophone", "Trompette", "Cor d’harmonie", "Trombone", "Tuba", "Timbales", "Percussions", "Harpe", "Claviers"];
  let lignes = this.totaliteLignes;
  lignes.sort(function(x,y){
    let cx = String(x.children[index].textContent.trim());
    let cy = String(y.children[index].textContent.trim());
    return ordre.indexOf(cx) - ordre.indexOf(cy);
  });
  this.remplaceLignes(lignes, index);  
};


Matrice.prototype.triEntier = function(index){
  let lignes = this.totaliteLignes;
  lignes.sort(function(x,y){
    let nx = Number.parseInt(x.children[index].textContent.trim(), 10);
    let ny = Number.parseInt(y.children[index].textContent.trim(), 10);
    return (nx > ny) ? 1 : (nx < ny) ? -1 : 0;
  });
  this.remplaceLignes(lignes, index);
};

Matrice.prototype.triDate = function(index){  
  //Pas nécessaire d’utiliser l’objet Date, donc utilisation d’une chaîne.
  function conversionDateAAAAMMJJ(ligne){
    let jjmmaaaa = ligne.children[index].textContent.trim();
    let _aaaammjj = jjmmaaaa.split('-').reverse();
    let aaaammjj = _aaaammjj.join('');
    return aaaammjj;
  };

  lignes = this.totaliteLignes;
  
  lignes.sort(function(x,y){
    let dx = conversionDateAAAAMMJJ(x);
    let dy = conversionDateAAAAMMJJ(y);
    //return (dx > dy) ? 1 : (dx < dy) ? -1 : 0;
    return dx.localeCompare(dy);
  });
  
  this.remplaceLignes(lignes, index);
};




(function(){

  // let tableau = document.getElementById('instrumentistes');
  let tableau = document.getElementsByClassName('instrumentistes');
  //console.log(tableau);

  function nouvelleInstance(envoi){
    let x = new Matrice;
    x.matrice = envoi;
    return x;
  };

  //let instrumentistes = nouvelleInstance(tableau);
  //instrumentistes.initialisation();
  for(var i = 0; i<tableau.length; i++){
    let instrumentiste  = nouvelleInstance(tableau[i]);
    instrumentiste.initialisation();
  }
  
})();
