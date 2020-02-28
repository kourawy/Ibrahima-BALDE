// auteur: Ibrahima BALDE
window.addEventListener('load' , myprofile) ;
function myprofile() {
    var myPseudo = document.getElementById('mesInfos').textContent;
    //console.log(myPseudo);
    var url = '../services/findUtilisateur.php?pseudo='+myPseudo ;
    fetchFromJson(url).then(processAnswer).then(displayProfile);
}

function processAnswer(answer){
    if (answer.status == "ok"){

      return answer.result;
    }
    else
      throw new Error(answer.message);
}

function displayProfile(info) {
  var mesInfos = document.getElementById('mesInfos') ;
  mesInfos.textContent='';
  var tab = `
  <table class="tableau zebre">
<caption>Profil</caption>
<colgroup>
  <col />
  <col />
</colgroup>
<thead>
  <tr><th style="text-align:left;">Description</th><th>Valeur</th></tr>
</thead>

<tbody>
<tr><td>Pseudo</td><td>${info.pseudo} </td></tr>
  <tr><td>Nom</td><td> ---</td></tr>
  <tr><td>Prenom</td><td>---</td></tr>
  <tr><td>Mail</td><td>${info.mail}</td></tr>
  <tr><td>Ville</td><td>${info.ville}</td></tr>
  <tr><td>Description</td><td>${info.description}</td></tr>
  <tr><td>Nombre de posts</td><td>${info.nbposts}</td></tr>
  <tr><td>Nombre de station notées</td><td>${info.nbavis}</td></tr>
  <tr><td>Somme globale des notes</td><td>${info.total}</td></tr>
  <tr><td>nombre de likes</td><td>${info.nblike}</td></tr>
  <tr><td>nombre de dislikes</td><td>${info.nbnolike}</td></tr>
</tbody>
</table>`;
mesInfos.innerHTML= tab;

}
