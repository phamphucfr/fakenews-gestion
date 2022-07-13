'use strict';


function check_search(){
    let checkOK = true;
    
    document.getElementById("err-libelle").innerHTML = "";
    
    if(document.getElementById("pattern").value.length < 1){
        checkOK = false;
	document.getElementById("err-libelle").innerHTML = "Entrez au moins une caractère pour la recherche s'il vous plaît!";
    }
    if(checkOK) document.getElementById("search-form").submit();
}

function check(){
    let checkOK = true;
    
    document.getElementById("err-libelle").innerHTML = "";
    
    if(document.getElementById("libelle").value.length < 1){
        checkOK = false;
	document.getElementById("err-libelle").innerHTML = "Entrez au moins une caractère s'il vous plaît!";
    }
    if(checkOK) document.getElementById("zeform").submit();
}

function checkActu(){
    let checkOK = true;
    
    if(document.getElementById("err-titre"))
            document.getElementById("err-titre").innerHTML = "";
    if(document.getElementById("err-contenu"))
            document.getElementById("err-contenu").innerHTML = "";
    
    if((document.getElementById("titre"))&&(document.getElementById("contenu"))){
    let titre = document.getElementById("titre").value.length;
    let contenu = document.getElementById("contenu").value.length;

    if(titre<1){ checkOK = false; document.getElementById("err-titre").innerHTML = "Entrez au moins une caractère s'il vous plaît!";}
    if(contenu<1){ checkOK = false; document.getElementById("err-contenu").innerHTML = "Entrez au moins une caractère s'il vous plaît!"; }
    }
 
    if(checkOK) document.getElementById("zeform").submit();
}



