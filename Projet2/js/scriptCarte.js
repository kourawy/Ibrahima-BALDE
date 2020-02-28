// auteur: Ibrahima BALDE

window.addEventListener("load",dessinerCarte);
var currentStation ;
// fonction de mise en place de la carte.
// Suppose qu'il existe dans le document
// un Ã©lÃ©ment possÃ©dant id="cartecampus"
function dessinerCarte(){
    // crÃ©ation de la carte, centrÃ©e sur le point 50.60976, 3.13909, niveau de zoom 16
    // cette carte sera dessinÃ©e dans l'Ã©lÃ©ment HTML "cartecampus"
    var map = L.map('cartecampus').setView([50.60976, 3.13909], 16);

    // ajout du fond de carte OpenStreetMap
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);


    placerMarqueurs(map);
    map.on("popupopen",activerBouton);
}

// gestionnaire d'Ã©vÃ¨nement (dÃ©clenchÃ© lors de l'ouverture d'un popup)
// cette fonction va rendre actif le bouton inclus dans le popup en lui assocaint un gestionnaire d'Ã©vÃ¨nement

function placerMarqueurs(map) {
   var l = document.querySelectorAll("table#communes>tbody>tr"); //liste de toutes les lignes
   console.log(l);
   var pointList= [];
   for (var i=0; i<l.length; i++){ // pour chaque ligne, insertion d'un marqueur sur la carte
        // insertion du marqueur selon les coordonnÃ©es trouvÃ©es dans les attributs data-lat et data-lon :
        var point = [l[i].dataset.lat, l[i].dataset.lon];
        var name = l[i].dataset.nom ;
        var marque = l[i].dataset.marque ;
        var id = l[i].dataset.id ;

        L.marker(point).addTo(map).bindPopup("Name : "+name + ", Marque : " + marque + " " + "<button value=\""+id+"\"> Information</button>").openPopup();
        pointList.push(point);
   }
   map.fitBounds(pointList);
}
// ajustement de la zone d'affichage de la carte aux points marquÃ©s

function activerBouton(ev) {
    var noeudPopup = ev.popup._contentNode; // le noeud DOM qui contient le texte du popup
    var bouton = noeudPopup.querySelector("button"); // le noeud DOM du bouton inclu dans le popup
    bouton.addEventListener("click", clickInfo); // en cas de click, on dÃ©clenche la fonction clickInfo
}

// gestionnaire d'Ã©vÃ¨nement (dÃ©clenchÃ© lors d'un click sur le bouton dans un popup)

function clickInfo(){


  var l = document.querySelectorAll("table#communes>tbody>tr");
  document.getElementById('infos').innerHTML = "" ;
  for (var i=0; i<l.length; i++){
    if(this.value == l[i].dataset.id){
            document.getElementById('identifiant').innerHTML = l[i].dataset.id ;
            document.getElementById('nom').innerHTML = "Nom : " + l[i].dataset.nom ;
            document.getElementById('marque').innerHTML = "Marque :" + l[i].dataset.marque ;
            document.getElementById('adresse').innerHTML = "Adresse : " + l[i].dataset.adresse ;
            document.getElementById('carburants').innerHTML =  "Types Carburants : " + l[i].dataset.libellecarburant ;
            document.getElementById('prix').innerHTML = "Prix : " +  l[i].dataset.prix ;
            document.getElementById('services').innerHTML = " Services : " + l[i].dataset.services ;
            document.getElementById('cp').innerHTML = " CP : " + l[i].dataset.cp ;
            document.getElementById('ville').innerHTML = " Ville : " + l[i].dataset.ville ;
          }

    }
    let res = document.getElementById('identifiant');
     currentStation = res.textContent;
    res.style.display='none';
    findStation();
    findPosts();
    //noteStation();
    //incrementeAvis();
  }
