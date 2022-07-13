<?php

class ManagerUser {
    static function checkUser(PDO $cnx, User $objetUser){
        //User final par défaut
        $finalUser = null;
        $email = $objetUser->getEmail();
        $pass = $objetUser->getPass();
        
        $sql = "SELECT id_user, nom, prenom
                FROM users
                WHERE email = ? AND pass = ?";
        
        $PDOStmt = $cnx->prepare($sql);
        $PDOStmt->bindParam(1,$email,PDO::PARAM_STR);
        $PDOStmt->bindParam(2,$pass,PDO::PARAM_STR);
        $PDOStmt->execute();
        
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $finalUser = new User();
            $finalUser->setIdUser($record->id_user); 
            $finalUser->setNom($record->nom); 
            $finalUser->setPrenom($record->prenom);        
        }
       
        return $finalUser;
    }
}
