// ajax_nouveau_theme.js
// Requette http->script.php

let libelleTheme = document.getElementById('libelle-theme');  // à ce stade la fonction ajaxCall n'est pas appelée, donc pas de VALUE

function ajaxCall(){
    
    let libTheme = libelleTheme.value;
    
    let xhr = new XMLHttpRequest();
    
    xhr.open('GET', 'services/serviceNewTheme.php?lib-theme='+libTheme);
    
    xhr.send();
    
    xhr.onreadystatechange = ()=>{
		
		if (xhr.readyState == 4 && xhr.status == 200){
			let data = xhr.responseText;    

                        processResponse(data, libTheme);

		} 
		
	};  
}



// Utiliser la réponse pour rafraichir le select des thèmes
function processResponse(data, libTheme){
    const listeJson = JSON.parse(data);   
    let optionsActuel = document.getElementById("liste-theme").options; 
    let testLibelle = true;
    
    for(let i=0; i<optionsActuel.length; i++){
        (optionsActuel[i].label === libTheme)?testLibelle = false: testLibelle = true;
    }
    
    if(testLibelle){
    const nouveauTheme = listeJson.find((theme)=>theme.libelle === libTheme);
    let newOption = document.createElement("option");
    newOption.value = nouveauTheme.idTheme;
    newOption.label = nouveauTheme.libelle;
    newOption.selected = true;
    document.getElementById("liste-theme").appendChild(newOption); 
    }
}