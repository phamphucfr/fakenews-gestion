<?php
// controller_actualites.php - controller spécifique
$actu = new Actualites();

// On charge le métier spécifique
if($_SESSION['prenom']=="Phuc"){
    switch($action){
            case "1":
                if(empty($_POST)){
                    include_once("views/actualites/create.php");
                }
                else{
                    if(isset($_POST["titre"])){
                        $actu->setTitre($_POST["titre"]);
                        }
                    if(isset($_POST["theme"])){
                        $idTheme = $_POST["theme"];
                        $actu->setTheme(ManagerTheme::findById($cnx, $idTheme));
                        }
                    if(isset($_POST["publish"])){
                        $actu->setPublish($_POST["publish"]);
                        }
                    if(isset($_POST["contenu"])){
                        $actu->setContenu($_POST["contenu"]);
                        }
                    if(isset($_POST["image"])){
                        $actu->setImage($_POST["image"]);
                        }

                    $actu->setDateCrea(date('Y-m-d H:i:s',time()));
                    $actu->setDateModif($actu->getDateCrea());

                    //insérer en BDD
                    ManagerActus::create($cnx, $actu);

                //Refresh liste des thèmes
                    $listeActus = ManagerActus::findAll($cnx);
                    include_once("views/actualites/liste.php");
                }

                break;

            case "2":
            // Modification
               if(empty($_POST)){
                   if(isset($_GET['id_actualite'])){
                    $actu = ManagerActus::findById($cnx, (int)$_GET['id_actualite']);
                    include_once("views/actualites/modify.php");
                   }
                }
                else{
                    if(isset($_POST["titre"])){
                        $actu->setTitre($_POST["titre"]);
                        }
                    if(isset($_POST["theme"])){
                        $idTheme = $_POST["theme"];
                        $actu->setTheme(ManagerTheme::findById($cnx, $idTheme));
                        }
                    if(isset($_POST["publish"])){
                        $actu->setPublish($_POST["publish"]);
                        }
                    if(isset($_POST["contenu"])){
                        $actu->setContenu($_POST["contenu"]);
                        }
                    if(isset($_POST["id_actualite"])){
                        $actu->setIdActu($_POST["id_actualite"]);
                        }
                    if(isset($_POST["image"])){
                        $actu->setImage($_POST["image"]);
                        }

                    $actu->setDateModif(date('Y-m-d H:i:s',time()));

                    //insérer en BDD
                    ManagerActus::modify($cnx, $actu);

                //Refresh liste des thèmes
                    $listeActus = ManagerActus::findAll($cnx);
                    include_once("views/actualites/liste.php");
                }

                break;


            case "3":
            // suppression del'actu
               if(empty($_POST)){
                   if(isset($_GET['id_actualite'])){
                    $actu = ManagerActus::findById($cnx, (int)$_GET['id_actualite']);
                    include_once("views/actualites/delete.php");
                   }
                }
                else{
                    if(isset($_POST["id_actualite"])){
                        $actu = ManagerActus::findById($cnx,(int)$_POST["id_actualite"]);
                        }
                ManagerActus::delete($cnx, $actu);
                //Refresh liste des thèmes
                    $listeActus = ManagerActus::findAll($cnx);
                    include_once("views/actualites/liste.php");
                }

                break;

            case "4":
                // recherche des actus
                if(isset($_POST['pattern'])){
                    if(!empty($_POST['pattern'])){
                       $pattern = $_POST['pattern']; 
                       $listeActus = ManagerActus::findAllwithFilter($cnx, $pattern);

                        include_once("views/actualites/liste.php");
                    }
                    else{ 
                    $listeActus = ManagerActus::findAll($cnx);
                    include_once("views/actualites/liste.php");
                    }
                }

                    break;

            case "5":
            // Publication
                    if(isset($_POST["id_actualite"])){
                        $actu = ManagerActus::findById($cnx,(int)$_POST["id_actualite"]);
                        }

                    if(isset($_POST["publish".$_POST["id_actualite"]])){
                        $state = $_POST["publish".$_POST["id_actualite"]];
                        if($state=="Online") $actu->setPublish(0); 
                        if($state=="Offline") $actu->setPublish(1); 
                        }

                    //insérer en BDD
                    ManagerActus::publish($cnx, $actu);

                //Refresh liste des thèmes
                    $listeActus = ManagerActus::findAll($cnx);
                    include_once("views/actualites/liste.php");

                break;


            case "6":
            // Gestion des Tags sur l'actu
                if(empty($_POST)){
                if(isset($_GET['id_actualite'])){
                     $listeTags = ManagerTags::getTagsNotActu($cnx, (int)$_GET['id_actualite']);
                     $listeTagsActu = ManagerTags::getTagsActu($cnx, (int)$_GET['id_actualite']);
                     include_once("views/actualites/tagsGestion.php");
                    }
                   else include_once("views/actualites/liste.php"); 
                }
                else{
                   $listeIdTags = []; 
                   if(isset($_POST['id_actualite'])) {$actuId = $_POST['id_actualite'];}
                   if(isset($_POST['liste_droite'])) {$listeIdTags = $_POST['liste_droite'];}

                   ManagerTags::updateTagsActu($cnx,$actuId,$listeIdTags);

                   // retour vers view Actus                          
                    $listeActus = ManagerActus::findAll($cnx);
                    include_once("views/actualites/liste.php");
                }

                break;



            case "0": default:
            // liste des actus
                    $listeActus = ManagerActus::findAll($cnx);
                    include_once("views/actualites/liste.php");
                    break;
    }
}
else{
    switch ($action){
           case "4":
                // recherche des actus
                if(isset($_POST['pattern'])){
                    if(!empty($_POST['pattern'])){
                       $pattern = $_POST['pattern']; 
                       $listeActus = ManagerActus::findAllwithFilter($cnx, $pattern);

                        include_once("views/actualites/liste.php");
                    }
                    else{ 
                    $listeActus = ManagerActus::findAll($cnx);
                    include_once("views/actualites/liste.php");
                    }
                }

                    break;
                    
            case "0": default:
            // liste des actus
                    $listeActus = ManagerActus::findAll($cnx);
                    include_once("views/actualites/liste.php");
                    break;
    }

}



?>