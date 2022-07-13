<?php


class ManagerActus {
        //----------------------Methode findAll()----------------------------------
    static function findAll(PDO $cnx){
        // String Requete SQL
        $sql = "SELECT actu.id_actualite, actu.titre, actu.contenu, actu.theme, 
            actu.date_creation, actu.date_modif, actu.publish, actu.url_image, 
            themes.id_theme, themes.libelle 
                FROM actualites AS actu
                INNER JOIN themes
                ON actu.theme = themes.id_theme
                ORDER BY libelle, actu.titre";

        $PDOStmt = $cnx->prepare($sql);

        $PDOStmt->execute();
        
        $liste = [];
        
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $theme = new Theme();
            $theme->setIdTheme($record->id_theme);
            $theme->setLibelle($record->libelle);
            
            $obj = new Actualites();
            $obj->setIdActu($record->id_actualite); 
            $obj->setTitre($record->titre); 
            $obj->setContenu($record->contenu); 
            $obj->setTheme($theme); 
            $obj->setDateCrea($record->date_creation); 
            $obj->setDateModif($record->date_modif);  
            $obj->setImage($record->url_image);
            $obj->setPublish($record->publish);
            
            array_push($liste, $obj);            
        }
        
        return $liste;
    } 
    
  //----------------------Methode findAll() surchargée avec filtre recherche----------------------------------
       static function findAllwithFilter(PDO $cnx, $pattern){
        // String Requete SQL
        $sql = "SELECT actu.id_actualite, actu.titre, actu.contenu, actu.theme, 
            actu.date_creation, actu.date_modif, actu.publish, actu.url_image, 
            themes.id_theme, themes.libelle 
                FROM actualites AS actu
                INNER JOIN themes
                ON actu.theme = themes.id_theme
                WHERE actu.titre LIKE ?
                ORDER BY libelle, actu.titre";

        $PDOStmt = $cnx->prepare($sql);
        
        $stringPattern = "%".$pattern."%";
        $PDOStmt->bindParam(1, $stringPattern, PDO::PARAM_STR);
        
        $PDOStmt->execute();
        $liste = [];
        
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $theme = new Theme();
            $theme->setIdTheme($record->id_theme);
            $theme->setLibelle($record->libelle);
            
            $obj = new Actualites();
            $obj->setIdActu($record->id_actualite); 
            $obj->setTitre($record->titre); 
            $obj->setContenu($record->contenu); 
            $obj->setTheme($theme); 
            $obj->setDateCrea($record->date_creation); 
            $obj->setDateModif($record->date_modif);  
            $obj->setImage($record->url_image);
            $obj->setPublish($record->publish);
           
            array_push($liste, $obj);
        }
        
        return $liste;
    }  
   
  
   //----------------------Methode findByID()----------------------------------    
    static function findById(PDO $cnx, $idActu){

        // requete SQL
        $sql = "SELECT actu.id_actualite, actu.titre, actu.contenu, actu.theme, 
            actu.date_creation, actu.date_modif, actu.publish, actu.url_image, 
            themes.id_theme, themes.libelle 
                FROM actualites AS actu
                INNER JOIN themes
                ON actu.theme = themes.id_theme
                WHERE actu.id_actualite = ?";

        $PDOStmt = $cnx->prepare($sql);

        $PDOStmt->bindParam(1,$idActu,PDO::PARAM_INT);
        
        $PDOStmt->execute();
              
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $theme = new Theme();
            $theme->setIdTheme($record->id_theme);
            $theme->setLibelle($record->libelle);
            
            $obj = new Actualites();
            $obj->setIdActu($record->id_actualite); 
            $obj->setTitre($record->titre); 
            $obj->setContenu($record->contenu); 
            $obj->setTheme($theme); 
            $obj->setDateCrea($record->date_creation); 
            $obj->setDateModif($record->date_modif);  
            $obj->setImage($record->url_image);
            $obj->setPublish($record->publish);
            
        }

        return $obj;
    }
   
    //----------------------Methode create()----------------------------------
    
    static function create(PDO $cnx, Actualites $actu){
        $titre = $actu->getTitre();
        $contenu = $actu->getContenu();
        $theme = $actu->getTheme();
        $idTheme = $theme->getIdTheme();
        $dateCrea = $actu->getDateCrea();
        $dateModif = $actu->getDateModif();
        $publish = $actu->getPublish();
        $image = $actu->getImage();       
        
        $testValue = true;
        
        if($titre==null) $testValue=false;
        
        $listeActuelle = self::findAll($cnx);
        foreach($listeActuelle as $ActuActuel){
            if($titre==$ActuActuel->getTitre()){
                $testValue = false;
                break;
            }
        }
                
        
        if($testValue){       

            $sql="INSERT INTO actualites (titre, theme, contenu, date_creation, date_modif, publish, url_image)
                  VALUES (?, ?, ?, ?, ?, ?, ?)            
                 ";
            // Préparation
            $PDOStmt = $cnx->prepare($sql);

            // Binding les params par les "?" dans la requete SQL en haut
            $PDOStmt->bindParam(1,$titre,PDO::PARAM_STR);
            $PDOStmt->bindParam(2,$idTheme,PDO::PARAM_INT);
            $PDOStmt->bindParam(3,$contenu,PDO::PARAM_STR);
            $PDOStmt->bindParam(4,$dateCrea,PDO::PARAM_STR);
            $PDOStmt->bindParam(5,$dateModif,PDO::PARAM_STR);
            $PDOStmt->bindParam(6,$publish,PDO::PARAM_INT);
            $PDOStmt->bindParam(7,$image,PDO::PARAM_STR);

            // Exécution de la requete
            $PDOStmt->execute();
            }
        
        }
        
        
    static function modify(PDO $cnx, Actualites $actu){
        $idActu = $actu->getIdActu();
        $titre = $actu->getTitre();
        $contenu = $actu->getContenu();
        $theme = $actu->getTheme()->getIdTheme();
        $dateModif = $actu->getDateModif();
        $publish = $actu->getPublish();
        $image = $actu->getImage();            
                     
      

            $sql="UPDATE actualites 
                  SET titre = ?, theme = ?, contenu = ?, date_modif = ?, publish = ?, url_image = ?
                  WHERE id_actualite = ? ;
                 ";
            // Préparation
            $PDOStmt = $cnx->prepare($sql);

            // Binding les params par les "?" dans la requete SQL en haut
            $PDOStmt->bindParam(1,$titre,PDO::PARAM_STR);
            $PDOStmt->bindParam(2,$theme,PDO::PARAM_INT);
            $PDOStmt->bindParam(3,$contenu,PDO::PARAM_STR);
            $PDOStmt->bindParam(4,$dateModif,PDO::PARAM_STR);
            $PDOStmt->bindParam(5,$publish,PDO::PARAM_INT);
            $PDOStmt->bindParam(6,$image,PDO::PARAM_STR);
            $PDOStmt->bindParam(7,$idActu,PDO::PARAM_INT);

            // Exécution de la requete
            $PDOStmt->execute();
            
        
        }
      
     
    static function delete(PDO $cnx, Actualites $actu){
        $idActu = $actu->getIdActu();             
               
        $sql="DELETE FROM actualites
              WHERE id_actualite = ? ";
        // Préparation
        $PDOStmt = $cnx->prepare($sql);

        // Binding les params par les "?" dans la requete SQL en haut
        $PDOStmt->bindParam(1, $idActu, PDO::PARAM_INT);

        // Exécution de la requete
        $PDOStmt->execute();
            
    }
    
    
    static function publish(PDO $cnx, Actualites $actu){
        $idActu = $actu->getIdActu();
        $publish = $actu->getPublish();
               
                    
            $sql="UPDATE actualites 
                  SET publish = ?
                  WHERE id_actualite = ? ;
                 ";
            // Préparation
            $PDOStmt = $cnx->prepare($sql);

            // Binding les params par les "?" dans la requete SQL en haut
            $PDOStmt->bindParam(1,$publish,PDO::PARAM_INT);
            $PDOStmt->bindParam(2,$idActu,PDO::PARAM_INT);

            // Exécution de la requete
            $PDOStmt->execute();
            
        
        }
        
  
     
}
