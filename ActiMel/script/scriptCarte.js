/*
 Ce fichier nous permet de creer et de manipuler la carte(map).
 Manipulations possible:
	- Création des markeurs pour chaque entreprise trouvée
	- Un click sur ce markeur affiche des infos utiles sur l'entreprise
	- Un click sur le nom de l'entreprise dans le tableau au dessus de la carte
	permet de se positionner sur la carte et affiche en grand l'entreprise sélectionnée
*/


/*
Cette fonction permet de creer le panel, c'est à dire ce qui affiche au dessus du
dans le texte affiché dans le popup une fois voir ckiqué sur un markeur.
*/
function panel(nom, adresse, activite, categorie, effectif, natJuridik){
	return "<ol><li> nom : "+nom+"</li><li> adresse : "+adresse+"</li><li> activite : "+activite+"</li><li> categorie : "+categorie+"</li><li> effectif : "+effectif+"</li><li> nature juridique : "+natJuridik+"</li></ol>";
}

/*
Cette fonction permet de creer des markeurs et d'y joindre leur popup
*/
function placerMarqueurs(map){
	var fields = document.querySelectorAll('td.field');
	var pointList = [];
	for(var i = 0; i < fields.length; i++){
		var nom = fields[i].getAttribute("data-nom");
		var adresse = fields[i].getAttribute("data-adresse");
		var activite = fields[i].getAttribute("data-activite");
		var categorie = fields[i].getAttribute("data-categorie");
		var effectif = fields[i].getAttribute("data-effectif");
		var natJuridik = fields[i].getAttribute("data-natjuridik");
		var longitude = fields[i].getAttribute("data-longitude");
		var latitude = fields[i].getAttribute("data-latitude");
		var texte = panel(nom, adresse, activite, categorie, effectif, natJuridik);
		var point = [latitude, longitude];
		L.marker(point).addTo(map).bindPopup(texte);
		var t = document.querySelectorAll('img[tabindex="0"]');
		t[t.length-1].setAttribute("id", longitude);
		pointList.push(point);
		fields[i].addEventListener("click", zoomSurEntreprise);

	}
	map.fitBounds(pointList);
}

/*
cette fonction permet de mettre en evidence l'entreprise sur lequel on a cliqué 
dans le tableau. 
*/
function zoomSurEntreprise(){
	var fields = document.querySelectorAll('td.field');
	for(var i = 0; i < fields.length; i++){
		id = fields[i].getAttribute("data-longitude");
		var popUp = document.getElementById(id);
		popUp.style.width = "25px";
		popUp.style.height = "auto";
	}
	var id = this.getAttribute("data-longitude");
	var popUp = document.getElementById(id);
	var fields = document.querySelectorAll('td.field');
	popUp.style.width = "60px";
	popUp.style.height = "60px";
}

/*
Dessine la carte avec pour point fixe Lille.
*/
function dessinerCarte(){
	// creation de la carte dans l'element html map
	var map = L.map('map').setView([50.6333, 3.0667], 16);
	// ajout du fond
	L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap>/a> contributors'
    }).addTo(map);
    placerMarqueurs(map);
}

window.addEventListener("load", dessinerCarte);