// auteur: Ibrahima BALDE 
function setupListener() {
  myposts();

}
window.addEventListener('load' , setupListener) ;


//var bouttons = document.getElementsByTagName('button',true) ;
//var tableau = Array.from(bouttons) ;
//console.log(bouttons);

/*
for (let bout of bouttons) {
  //console.log(bout);
  bout.addEventListener('click' ,delPost) ;
}
*/



function myposts() {
    var myPseudo = document.getElementById('myPosts').textContent;
    //console.log(myPseudo);
    var url = '../services/findMesPosts.php' ;
    fetchFromJson(url).then(processAnswer).then(displayPosts);
}

function processAnswer(answer){
    if (answer.status == "ok"){

      return answer.result;
    }
    else
      throw new Error(answer.message);
}

function affiche(chaine) {
  if (chaine ===null) {
    return ;
  }
  else {
    return chaine ;
  }
}

function conversion(nombre) {
    if (nombre === null) {
        return 0 ;
    }
    else{
        return nombre ;
    }
}
var createBlock = function (tag, content, cssClass ,cssId) {
	var element = document.createElement(tag);
	if (cssClass != undefined) {
		element.className =  cssClass;
	}
  if (cssId != undefined) {
		element.id =  cssId;
	}
	element.innerHTML = content;
	return element;
}

var createFigureBlock = function (product) {
	//creer le noeud figure
	var fig=createBlock("figure", "");
	//creer le noeud image
	var img=document.createElement("img");
	//definit ses attributs et valeurs
	img.alt=product.name;
	img.src=product.image;
	//ajoute a figure
	fig.appendChild(img);
	return fig
}

var createBlockEntete = function (product) {
	//creer le noeud figure
	var fig=createBlock("figure", "");
	//creer le noeud image
	var img=document.createElement("img");
	//definit ses attributs et valeurs
	img.alt=product.name;
	img.src=product.image;
	//ajoute a figure
	fig.appendChild(img);
	return fig
}

function displayPosts(info) {
  var myPosts = document.getElementById('myPosts') ;
  myPosts.textContent='';
  // Creation du bloc de la date
  var div = document.createElement("div");
  div.id = "datesearch";
  div.innerHTML = "Date : "+info.date;
  var br = document.createElement("br");
  div.appendChild(br);
  myPosts.appendChild(div);
  info = info.liste ;


  //var tab = `<div id="datesearch"> Date : ${info.date}</div> <br/>`;
  //info = info.liste ;
  for (let e of info) {
    // Creation de l'article
    var article = document.createElement("article");
    article.className = "myposts";
    article.id="article"+"-"+e.id ;
     // Creation de l entete
    var p = document.createElement("p");
    var b = document.createElement("b");
    b.innerHTML="posté le "+e.datecreation ;
    p.appendChild(b) ;

    // bouton fermer
    var img = document.createElement("img");
    img.src ="../images/fermeture.jpeg" ;
    img.alt="fermer" ;
    img.title="fermer" ;
    img.className = "close-button" ;
    img.id="fermer"+"-"+e.id ;
    img.width="30" ;
    img.height="30" ;

    img.addEventListener('click', () => alert('ok') );
    // Ajout du boutton dans le span

    var span = document.createElement("span");
    span.className = "droite";
    span.appendChild(img);

    // Ajout du span dans p
    p.appendChild(span);
    // ajout du p dans article
    article.appendChild(p);

    // Affichage de la station
    var aff = "station :  "+affiche(e.station) ;
    article.appendChild(createBlock("h3" , aff));
    // affichage du titre
    var aff2 = "titre :  "+affiche(e.station) ;
    article.appendChild(createBlock("p" , aff2 ,"titre"));

    // affichage du contenu
    var aff3 = e.contenu ;
    article.appendChild(createBlock("p" , aff3 ,"contenu"));

    // Affichage des likes et dislikes
    var p2 = document.createElement("p");
    p2.className = "avis" ;

    var span2 = document.createElement("span");
    span2.className = "like" ;
    span2.textContent= conversion(e.nblike) ;

    var img3 = document.createElement("img");
    img3.src="../images/like.png" ;
    img3.alt = "like";
    img3.title="like";
    img3.width="30";
    img3.height="30";
    span2.appendChild(img3);
    p2.appendChild(span2);

    var span3 = document.createElement("span");
    span3.className = "dislike" ;
    span3.textContent= conversion(e.nbnolike) ;

    var img4 = document.createElement("img");
    img4.src="../images/dislike.jpeg" ;
    img4.alt = "dislike";
    img4.title="dislike";
    img4.width="30";
    img4.height="30";
    span3.appendChild(img4);
    p2.appendChild(span3);

    article.appendChild(p2);

    // ajout de l'article dans les posts



    myPosts.appendChild(article);

  }


  }
