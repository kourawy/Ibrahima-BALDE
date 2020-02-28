// auteurs: Ibrahima BALDE
window.addEventListener('click',findStation);
window.addEventListener('click',findPosts);
window.addEventListener('load',incrementeAvis);


function findStation(){
     let url ='services/findStation.php?id='+currentStation;

     fetchFromJson(url).then(processAnswer).then(displayNote);
}

function processAnswer(answer){
    if (answer.status == "ok"){

      return answer.result;
    }
    else
      throw new Error(answer.message);
}

function displayNote(info){
    /** for(let elt of Object.values(info))
         console.log(elt);*/

    var globale = document.getElementById('global');
    var accueil = document.getElementById('accueil');
    var prix = document.getElementById('prix');
    var service = document.getElementById('service');
    for(let e of [globale,accueil,prix,service])
         e.textContent='';

    globale.textContent= info.noteglobale ;


    accueil.textContent= info.noteaccueil ;


    prix.textContent= info.noteprix ;


    service.textContent= info.noteservice ;


}

function error(error) {
    let p = document.createElement('p');
    p.innerHTML = error.message;
    let cible  = document.querySelector('#errorMessage');
    cible.textContent=''; // effacement
    cible.appendChild(p);
}

// Gestion des posts


function findPosts(){
    let url ='services/findPosts.php?id='+currentStation;

    fetchFromJson(url).then(processAnswer).then(displayPosts);
}


function conversion(nombre) {
    if (nombre === null) {
        return 0 ;
    }
    else{
        return nombre ;
    }
}


function displayPosts(info){
   /*for(let elt of Object.values(info))
        console.log(elt);*/
    info = info.liste ;
   if (info) {
        var post = document.getElementById('posts');
        post.textContent='';
        var lesPosts = `<div id="postStation">`;
        for (let e of  info) {
            let postDescription =`<form>
            <fieldset>
                <legend>${e.datecreation}</legend>

                <label for="avatar" id="postAvatar"><img src="images/avatar.png" alt="avatar" width="42" height="42"/></label>

                <label for="contenu" id="postContenu">${e.contenu}</label>

                <label for="personne" id="personne">${e.auteur}</label>

                <label  class="like"> <span class="data-nblike">${conversion(e.nblike)}</span> <img src="images/like.png" alt="like" width="30" height="30"/> </label>


                <label  class="dislike"> <span class="data-nbnolike">${conversion(e.nbnolike)}</span> <img src="images/dislike.jpeg" alt="dislike"  width="30" height="30" />  </label>


            </fieldset>
            </form></br>`;
            //console.log(`<span>${e.id}</span>`);
            lesPosts+=postDescription ;

        }
        lesPosts+=`</div>`;
    }

   post.innerHTML=lesPosts ;
   //alert(lesPosts);
}


// Gestion du like et nolike


    /**
    var idlike='like'+'-'+parseInt(this.id);
    var boutonlike = document.getElementById(idlike);

    var idnblike='nblike'+'-'+parseInt(this.id);
    var boutonnblike = document.getElementById(idnblike);
    */

   function incrementeAvis() {
    var likes = document.querySelectorAll('label.like');
    //console.log(currentStation);
    //console.log(likes);
    for (let ek of  likes) {
        //console.log(ek);
        this.addEventListener('click',notePostLike);

     }

    var nolikes = document.querySelectorAll('label.dislike');
    for (let ev of  nolikes) {
        //console.log(ev);
        this.addEventListener('click',notePostNoLike);

     }
   }



var avis = '';
function notePostLike(ev){
    ev.preventDefault();
    //console.log(ev.preventDefault() , currentStation) ;
    avis = 'like';
    let url ='services/notePost.php?id='+currentStation+'&avis=like';

    fetchFromJson(url,{method:'post'}).then(processAnswer).then(setNotePost);
}

function notePostNoLike(ev){
    ev.preventDefault();
    avis = 'nolike';
    let url ='services/notePost.php?id='+currentStation+'&avis=nolike';

    fetchFromJson(url,{method:'post'}).then(processAnswer).then(setNotePost);
}

function setNotePost(info) {
    info = info.result ;
    if (avis == 'like') {

        this.firstChild.value = info.nblike ;
    }
    else if(avis == 'nolike'){
        this.firstChild.value = info.nbnolike ;
    }

}

function noteStation() {
  var glob = document.getElementById('score-noteGlobale').textContent;
  var acc = document.getElementById('score-noteAccueil').textContent;
  var pr = document.getElementById('score-notePrix').textContent;
  var serv = document.getElementById('score-noteService').textContent;
  console.log(glob , acc , pr , serv , currentStation);
  if (glob == null || acc == null || pr==null ||serv==null) {

  }else {
    let url ='services/noteStation.php';
    let args = new FormData();
    args.append('id',currentStation);
    args.append('global',parseInt(glob));
    args.append('accueil',parseInt(acc));
    args.append('prix',parseInt(pr));
    args.append('service',parseInt(serv));
    fetchFromJson(url,{method:'post' , body:args, credentials: 'same-origin'}).then(processAnswer).then(displayNote);

  }
}

function envoie(ev) {
  ev.preventDefault();
  let args = new FormData(this);
  args.append('station',currentStation);
  let url = 'services/createPost.php' ;
  fetchFromJson(url,{method:'post' , body:args, credentials: 'same-origin'}).then(processAnswer).then(findPosts);
}
