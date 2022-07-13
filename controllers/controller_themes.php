<?php
//include("models/ManagerTheme.php");
//// controller_themes.php - controller spécifique
//// objet 'métier' pratique pour stocker les données en retour du form
$theme = new Theme();

if($_SESSION['prenom']=="Phuc"){
    switch($action){
            case "1":
                //distinction methode http
    //	// création des thèmes
                //superglobale $_POST vide? alors on est en GET
                if(empty($_POST)){
                    include_once("views/themes/create.php");
                }
                //POST?
                //récupérer les données de form
                //fabriquer un objet
                else{
                    if(isset($_POST["libelle"])){
                        $theme->setLibelle($_POST["libelle"]);
                    }

                                //insérer en BDD
                ManagerTheme::create($cnx, $theme);

                //Refresh liste des thèmes
                $listeThemes = ManagerTheme::findAll($cnx);
                //var_dump $liste theme
                include_once("views/themes/liste.php");
                }

                break;	


            case "2":
               // Modifier un thème
                if(empty($_POST)){
                    //on récupère le id_theme
                    if(isset($_GET['id_theme'])){
                        $theme = ManagerTheme::findById($cnx, (int)$_GET['id_theme']);
                        include_once("views/themes/modify.php");
                    }
                }
                else{
                    if(isset($_POST['id_theme']))
                        $theme->setIdTheme($_POST['id_theme']);
                    if(isset($_POST['libelle']))
                        $theme->setLibelle($_POST['libelle']);


                    ManagerTheme::modify($cnx, $theme);    

                //Refresh liste des thèmes
                $listeThemes = ManagerTheme::findAll($cnx);

                include_once("views/themes/liste.php");

                }

                    break;	

            case "3":
                // suppression du thème
                if(empty($_POST)){
                    //on récupère le id_theme
                if(isset($_GET['id_theme'])){
                        $theme = ManagerTheme::findById($cnx, (int)$_GET['id_theme']);
                        include_once("views/themes/delete.php");
                    }
                }
                else{
                    if(isset($_POST['id_theme']))
                        $theme->setIdTheme($_POST['id_theme']);
                    if(isset($_POST['libelle']))
                        $theme->setLibelle($_POST['libelle']);


                    ManagerTheme::delete($cnx, $theme);    

                //Refresh liste des thèmes
                $listeThemes = ManagerTheme::findAll($cnx);

                include_once("views/themes/liste.php");

                }

                    break;
            case "4":
                // recherche des thèmes
                if(isset($_POST['pattern'])){
                    if(!empty($_POST['pattern'])){
                       $pattern = $_POST['pattern']; 
                       $listeThemes = ManagerTheme::findAllwithFilter($cnx, $pattern);

                        include_once("views/themes/liste.php");
                    }
                    else{ 
                    $listeThemes = ManagerTheme::findAll($cnx);
                    include_once("views/themes/liste.php");
                    }
                }

                    break;


            case "0": default:
            // liste des thèmes
                    $listeThemes = ManagerTheme::findAll($cnx);
                    include_once("views/themes/liste.php");

                    break;
    }
}
else{
   switch ($action){
            case "4":
            // recherche des thèmes
            if(isset($_POST['pattern'])){
                if(!empty($_POST['pattern'])){
                $pattern = $_POST['pattern']; 
                $listeThemes = ManagerTheme::findAllwithFilter($cnx, $pattern);

                include_once("views/themes/liste.php");
            }
            else{ 
                $listeThemes = ManagerTheme::findAll($cnx);
                include_once("views/themes/liste.php");
            }
        }

            break;
                    
            case "0": default:
                // liste des thèmes
                $listeThemes = ManagerTheme::findAll($cnx);
                include_once("views/themes/liste.php");
            
                break;
    }
}

?>