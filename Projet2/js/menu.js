// auteur: Ibrahima BALDE 
window.addEventListener('load',menu());

function menu() {
    //ev.preventDefault();
    if (document.getElementById("connect")) {
        var etat = document.getElementById("connect") ;
        if (etat.value != null) {
            var monMenu = document.getElementsByTagName("header") ;
            monMenu[0].textContent="";
            //console.log(monMenu) ;
            let contenu = `
            <header>
            <nav>
              <ul>
                <li class="titre">Carbadvisor      </li>
                <li> <a href="#">Accueil</a> </li>
                <li> <a href="views/recherche.php">Station</a> </li>
                <li> <a href="views/pagePost.php">Mes posts</a> </li>
                <li> <a href="views/profil.php">Mon profil</a> </li>
                <li> <a href="#">A propos</a> </li>
                <li> <a href="#">Contact</a> </li>
                <li class="droite"> <a href="#"> <img src="images/avatar.png" alt="avatar" height="30" width="30"> </a> </li>
                <li class="droite"> <a href="services/logout.php"> Deconnection </a> </li>
              </ul>
            </nav>

          </header>` ;
            monMenu[0].innerHTML = contenu ;
            //console.log(monMenu) ;
        }
    }

    else{
        document.getElementById("notation_station").innerHTML="";
        document.getElementById("post").innerHTML="";
    }

}
