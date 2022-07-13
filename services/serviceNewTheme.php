<?php
include('../tools/MaConnexion.php');
include('../models/Theme.php');
include('../models/ManagerTheme.php');
// Connexion
$cnx = MaConnexion::connect();
//var_dump($cnx);

// Récupérer la valeur de http var: lib-theme
if(isset($_GET['lib-theme'])){
    
    $objTheme = new Theme();
    
    $objTheme->setLibelle($_GET['lib-theme']);
    
    ManagerTheme::create($cnx, $objTheme);
    
    $listeThemes = ManagerTheme::findAll($cnx);
    
    echo json_encode($listeThemes, JSON_UNESCAPED_UNICODE);
    
}



// Requete SQL => insertion de new theme


// Requete SQL => refresh liste thème


// Print String JSON

