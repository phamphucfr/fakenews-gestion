<?php


class ManagerTags {
     //----------------------Methode findAll()----------------------------------
    static function findAll(PDO $cnx){
        // String Requete SQL
        $sql = "SELECT id_keyword, libelle  
                FROM keywords
                ";
        // ON PREPARE LA REQUETE (plus sécurisé que la requete directe car protège contre des injection SQL et rapidité en cas de requete multiple)
        // La méthode 'prepare()'de l'objet PDO retourne un objet PDOStatement
        $PDOStmt = $cnx->prepare($sql);
        
        // De l'éventuel binding (2ways)
        // :toto
        // ?
        
        // Exécution de la requete
        $PDOStmt->execute();
        $listeTags = [];
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = new Tags();
            $obj->setIdTag($record->id_keyword); // id de la colonne
            $obj->setNameTag($record->libelle); // nom de la colonne
            
            array_push($listeTags, $obj);
        }
        
        return $listeTags;
    }  
   
    //----------------------Methode findAll() surchargée avec filtre recherche----------------------------------
    static function findAllwithFilter(PDO $cnx, $pattern){
        // String Requete SQL
        $sql = "SELECT id_keyword, libelle 
                FROM keywords
                WHERE libelle LIKE ?
                ORDER BY libelle";

        $PDOStmt = $cnx->prepare($sql);
        
        $stringPattern = "%".$pattern."%";
        $PDOStmt->bindParam(1, $stringPattern, PDO::PARAM_STR);
        
        $PDOStmt->execute();
        $liste = [];
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = new Tags();
            $obj->setIdTag($record->id_keyword); // id de la colonne
            $obj->setNameTag($record->libelle); // nom de la colonne
            
            array_push($liste, $obj);
        }
        
        return $liste;
    } 
    //----------------------Methode create()----------------------------------
    
    static function create(PDO $cnx, Tags $tag){
        $libelle = $tag->getNameTag();
        $testValue = true;
        
        $listeActuelle = ManagerTags::findAll($cnx);
        foreach($listeActuelle as $tagActuel){
            if(($libelle==null)||($libelle==$tagActuel->getNameTag())){
                $testValue = false;
                break;
            }
            else{
                $testValue = true;
            }
        }
                
        
            if($testValue){       

            $sql="INSERT INTO keywords (libelle)
                  VALUES (?)            
                 ";
            // Préparation
            $PDOStmt = $cnx->prepare($sql);

            // Binding les params par les "?" dans la requete SQL en haut
            $PDOStmt->bindParam(1,$libelle,PDO::PARAM_STR);

            // Exécution de la requete
            $PDOStmt->execute();
            }
        
        }
  
    //----------------------Methode modify()----------------------------------    
    static function findById(PDO $cnx, $id){
        // requete SQL
        $sql = "SELECT id_keyword, libelle
                FROM keywords
                WHERE id_keyword = ? ";
             
        // Préparation
        $PDOStmt = $cnx->prepare($sql);

        // Binding les params par les "?" dans la requete SQL en haut
        $PDOStmt->bindParam(1,$id,PDO::PARAM_INT);

        // Exécution de la requete
        $PDOStmt->execute();
        
        $retour = $PDOStmt->fetchObject();
        $obj = new Tags();
        $obj->setIdTag($retour->id_keyword);
        $obj->setNameTag($retour->libelle);

        return $obj;
    }
    
    static function modify(PDO $cnx, Tags $tag){
        $idTag = $tag->getIdTag();
        $libelle = $tag->getNameTag();
              
               
        $sql="UPDATE keywords
              SET libelle = ?
              WHERE id_keyword = ? ";
        // Préparation
        $PDOStmt = $cnx->prepare($sql);

        // Binding les params par les "?" dans la requete SQL en haut
        $PDOStmt->bindParam(1, $libelle, PDO::PARAM_STR);
        $PDOStmt->bindParam(2, $idTag, PDO::PARAM_INT);

        // Exécution de la requete
        $PDOStmt->execute();
            
    }

     
    static function delete(PDO $cnx, Tags $tag){
        $idTag = $tag->getIdTag();             
               
        $sql="DELETE FROM keywords
              WHERE id_keyword = ? ";
        // Préparation
        $PDOStmt = $cnx->prepare($sql);

        // Binding les params par les "?" dans la requete SQL en haut
        $PDOStmt->bindParam(1, $idTag, PDO::PARAM_INT);

        // Exécution de la requete
        $PDOStmt->execute();
            
    }
  
        static function getTagsNotActu(PDO $cnx, $id_actu){
            $liste = [];
      
            $sql="SELECT id_keyword FROM keywords 
                  WHERE id_keyword NOT IN 
                  (SELECT keyword FROM actualites_keywords WHERE actualite = ?)
                 ";
            // Préparation
            $PDOStmt = $cnx->prepare($sql);

            // Binding les params par les "?" dans la requete SQL en haut
            $PDOStmt->bindParam(1,$id_actu,PDO::PARAM_INT);

            // Exécution de la requete
            $PDOStmt->execute();
            
            while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = ManagerTags::findById($cnx, $record->id_keyword);
            array_push($liste, $obj);
            }
            
            return $liste;
        
        }
        
        
        static function getTagsActu(PDO $cnx, $id_actu){
            $liste = [];
      
            $sql="SELECT keyword
                  FROM actualites_keywords 
                  WHERE actualite = ?
                 ";
            // Préparation
            $PDOStmt = $cnx->prepare($sql);

            // Binding les params par les "?" dans la requete SQL en haut
            $PDOStmt->bindParam(1,$id_actu,PDO::PARAM_INT);

            // Exécution de la requete
            $PDOStmt->execute();
            
            while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = ManagerTags::findById($cnx, $record->keyword);
            array_push($liste, $obj);
            }
            
            return $liste;
        
        }
  
        static function updateTagsActu($cnx, $idActu, $listeIdTags){
           
               
        $sql1 = "DELETE FROM actualites_keywords
                 WHERE actualite = ? ";
        // Préparation
        $PDOStmt = $cnx->prepare($sql1);

        // Binding les params par les "?" dans la requete SQL en haut
        $PDOStmt->bindParam(1, $idActu, PDO::PARAM_INT);

        // Exécution de la requete
        $PDOStmt->execute();
        
        if(!empty($listeIdTags)){
            $sql2 = "INSERT INTO actualites_keywords(actualite,keyword)
                     VALUES (?,?)
                     ";            
            foreach($listeIdTags as $idTag){ 

            $PDOStmt = $cnx->prepare($sql2);

            // Binding les params par les "?" dans la requete SQL en haut
            $PDOStmt->bindParam(1, $idActu, PDO::PARAM_INT);
            $PDOStmt->bindParam(2, $idTag, PDO::PARAM_INT);

            // Exécution de la requete
            $PDOStmt->execute();
            }
        
        }

    }       
    
  
       
}
