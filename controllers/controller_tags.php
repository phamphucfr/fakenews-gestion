<?php

// controller_tags.php - controller spécifique
$tag = new Tags();

if($_SESSION['prenom']=="Phuc"){
    switch($action){
            case "1":
            // création de tag
                if(empty($_POST)){
                include_once("views/tags/create.php");
                }
                else{
                    if(isset($_POST["libelle"])){
                        $tag->setNameTag($_POST["libelle"]);
                    }

                //insérer en BDD
                ManagerTags::create($cnx, $tag);

                //Refresh liste des thèmes
                $listeTags = ManagerTags::findAll($cnx);
                //var_dump $liste theme
                include_once("views/tags/liste.php");
                }

                break;

            case "2":
            // modification du tag
                if(empty($_POST)){
                    if(isset($_GET['id_keyword'])){
                        $tag = ManagerTags::findById($cnx, (int)($_GET['id_keyword']));
                        include_once("views/tags/modify.php");
                    }
                }
                else{
                    if(isset($_POST['id_keyword'])){
                        $tag->setIdTag($_POST['id_keyword']);
                    }
                    if(isset($_POST['libelle'])){
                        $tag->setNameTag($_POST['libelle']);
                    }

                    ManagerTags::modify($cnx, $tag);

                    $listeTags = ManagerTags::findAll($cnx);
                    include_once("views/tags/liste.php");                
                }

                    break;	


            case "3":
                    // suppression du tag
                if(empty($_POST)){
                    if(isset($_GET['id_keyword'])){
                        $tag = ManagerTags::findById($cnx, (int)($_GET['id_keyword']));
                        include_once("views/tags/delete.php");
                    }
                }
                else{
                    if(isset($_POST['id_keyword'])){
                        $tag->setIdTag($_POST['id_keyword']);
                    }
                    if(isset($_POST['libelle'])){
                        $tag->setNameTag($_POST['libelle']);
                    }

                    ManagerTags::delete($cnx, $tag);

                    $listeTags = ManagerTags::findAll($cnx);
                    include_once("views/tags/liste.php");                
                }           
                    break;

            case "4":
                // recherche des thèmes
                if(isset($_POST['pattern'])){
                    if(!empty($_POST['pattern'])){
                       $pattern = $_POST['pattern']; 
                       $listeTags = ManagerTags::findAllwithFilter($cnx, $pattern);

                        include_once("views/tags/liste.php");
                    }
                    else{ 
                    $listeTags = ManagerTags::findAll($cnx);
                    include_once("views/tags/liste.php");
                    }
                }

                    break;


            case "0": default:
            // liste des tags
                    $listeTags = ManagerTags::findAll($cnx);
                    include_once("views/tags/liste.php");
                    break;
    }
}
else{
   switch ($action){
        case "4":
        // recherche des tags
        if(isset($_POST['pattern'])){
            if(!empty($_POST['pattern'])){
               $pattern = $_POST['pattern']; 
               $listeTags = ManagerTags::findAllwithFilter($cnx, $pattern);

                include_once("views/tags/liste.php");
            }
            else{ 
            $listeTags = ManagerTags::findAll($cnx);
            include_once("views/tags/liste.php");
            }
        }

            break;


        case "0": default:
        // liste des tags
            $listeTags = ManagerTags::findAll($cnx);
            include_once("views/tags/liste.php");
            break;
    }
}



?>