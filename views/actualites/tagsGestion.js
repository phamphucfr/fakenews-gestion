// tagsGestion.js
// Requette http->script.php

let listeGauche = document.getElementById("liste_gauche").options;
let listeDroite = document.getElementById("liste_droite").options; 


function envoyer(){
    let liste = [];    
    for(let i=0; i<listeDroite.length; i++){
        listeDroite[i].selected = true;
        liste.push(" "+listeDroite[i].text+" ");
    }

    let confirmOK = confirm("Voulez-vous ajouter les mots-clés ci-dessous à cet article? \n"+liste,"Attention!");
    if(confirmOK) document.getElementById('tags_form').submit();

}



// Utiliser la réponse pour rafraichir le select des thèmes
function addToRight(){
   let thisOption = listeGauche[listeGauche.selectedIndex];
   document.getElementById("liste_gauche").removeChild(thisOption);
   document.getElementById("liste_droite").appendChild(thisOption);
   thisOption.selected = false;
}

// Utiliser la réponse pour rafraichir le select des thèmes
function addToLeft(){
   let thisOption = listeDroite[listeDroite.selectedIndex];
   document.getElementById("liste_droite").removeChild(thisOption);
   document.getElementById("liste_gauche").appendChild(thisOption);
   thisOption.selected = false;
}

