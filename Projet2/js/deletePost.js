//window.addEventListener('load' , myposts) ;
// auteurs: Ibrahima BALDE
function setupListener2() {

  var id = parseInt(this.id);
  //console.log(id);
  var closeButton = document.getElementsByClassName('droite');
  //var lien = closeButton ;
  //closeButton[0][2].addEventListener("click",posts);
  var tableau = Array.from(closeButton) ;
  console.log(tableau);

  //
}
//myPseudo = document.getElementById('myPosts') ;
//myPseudo.addEventListener('load' , setupListener2) ;


function posts() {
  console.log(this.id);
  var selecti = "fermer"+this.id
  var boutton = document.getElementById();
  var nombre = parseInt("fermer"+this.id);
  var url = '../services/deletePost.php';
  let args = new FormData();
  args.append('id',nombre);
  fetchFromJson(url,{method:'post' , body:args, credentials: 'same-origin'}).then(processAnswer).then(displayDelete);
}



function displayDelete(info) {
  let identifiant = 'article'+this.id ;
  var articleSup = document.getElementById(identifiant) ;
  articleSup.textContent='';

}
