<?php
//include("Theme.php");

class ManagerTheme{
     
    static function findAll(PDO $cnx){
        // String Requete SQL
        $sql = "SELECT id_theme, libelle 
                FROM themes";
        // ON PREPARE LA REQUETE (plus sécurisé que la requete directe car protège contre des injection SQL et rapidité en cas de requete multiple)
        // La méthode 'prepare()'de l'objet PDO retourne un objet PDOStatement
        $PDOStmt = $cnx->prepare($sql);
        
        // De l'éventuel binding (2ways)
        // :toto
        // ?
        
        // Exécution de la requete
        $PDOStmt->execute();
        $liste = [];
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = new Theme();
            $obj->setIdTheme($record->id_theme); // id de la colonne
            $obj->setLibelle($record->libelle); // nom de la colonne
            
            array_push($liste, $obj);
        }
        
        return $liste;
    }  
    
     static function findAll2(PDO $cnx){
        // String Requete SQL
        $sql = "SELECT id_theme, libelle 
                FROM themes";
        // ON PREPARE LA REQUETE (plus sécurisé que la requete directe car protège contre des injection SQL et rapidité en cas de requete multiple)
        // La méthode 'prepare()'de l'objet PDO retourne un objet PDOStatement
        $PDOStmt = $cnx->prepare($sql);
        
        // De l'éventuel binding (2ways)
        // :toto
        // ?
        
        // Exécution de la requete
        $PDOStmt->execute();
        $liste = [];
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = new Theme();
            $obj->setIdTheme($record->id_theme); // id de la colonne
            $obj->setLibelle($record->libelle); // nom de la colonne
            
            //$arrayObj = (array)$obj; // Forcer Objet Theme en Array pour JSON Encode 
            
            array_push($liste, $arrayObj);
        }
        
        return $liste;
    } 
        //----------------------Methode findAll() surchargée avec filtre recherche----------------------------------
    static function findAllwithFilter(PDO $cnx, $pattern){
        // String Requete SQL
        $sql = "SELECT id_theme, libelle 
                FROM themes
                WHERE libelle LIKE ?
                ORDER BY libelle";

        $PDOStmt = $cnx->prepare($sql);
        
        $stringPattern = "%".$pattern."%";
        $PDOStmt->bindParam(1, $stringPattern, PDO::PARAM_STR);
        
        $PDOStmt->execute();
        $liste = [];
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = new Theme();
            $obj->setIdTheme($record->id_theme); // id de la colonne
            $obj->setLibelle($record->libelle); // nom de la colonne
            
            array_push($liste, $obj);
        }
        
        return $liste;
    }  
    
    //----------------------Methode create()----------------------------------
    
    static function create(PDO $cnx, Theme $theme){
        $libelle = $theme->getLibelle();
        $testValue = true;
        
        $listeActuelle = ManagerTheme::findAll($cnx);
        foreach($listeActuelle as $themeActuel){
            if(($libelle==null)||($libelle==$themeActuel->getLibelle())){
                $testValue = false;
                break;
            }
            else{
                $testValue = true;
            }
        }
                
        
            if($testValue){       

            $sql="INSERT INTO themes (libelle)
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
        $sql = "SELECT id_theme, libelle
                FROM themes
                WHERE id_theme = ? ";
             
        // Préparation
        $PDOStmt = $cnx->prepare($sql);

        // Binding les params par les "?" dans la requete SQL en haut
        $PDOStmt->bindParam(1,$id,PDO::PARAM_INT);

        // Exécution de la requete
        $PDOStmt->execute();
        
        $retour = $PDOStmt->fetchObject();
        $obj = new Theme();
        $obj->setIdTheme($retour->id_theme);
        $obj->setLibelle($retour->libelle);

        return $obj;
    }
    
    static function modify(PDO $cnx, Theme $theme){
        $id_theme = $theme->getIdTheme();
        $libelle = $theme->getLibelle();
              
               
        $sql="UPDATE themes
              SET libelle = ?
              WHERE id_theme = ? ";
        // Préparation
        $PDOStmt = $cnx->prepare($sql);

        // Binding les params par les "?" dans la requete SQL en haut
        $PDOStmt->bindParam(1, $libelle, PDO::PARAM_STR);
        $PDOStmt->bindParam(2, $id_theme, PDO::PARAM_INT);

        // Exécution de la requete
        $PDOStmt->execute();
            
    }
    
    static function delete(PDO $cnx, Theme $theme){
        $id_theme = $theme->getIdTheme();             
               
        $sql="DELETE FROM themes
              WHERE id_theme = ? ";
        // Préparation
        $PDOStmt = $cnx->prepare($sql);

        // Binding les params par les "?" dans la requete SQL en haut
        $PDOStmt->bindParam(1, $id_theme, PDO::PARAM_INT);

        // Exécution de la requete
        $PDOStmt->execute();
            
    }
        
}  

    
?>
