<?php 
// check.php
include("tools/MaConnexion.php");
//obtention d'une cnx
$cnx = MaConnexion::connect();
include("models/User.php");
include("models/ManagerUser.php");

// objet user
$user = null;

session_start();  // la toute première instruction obligatoire avant toute utilisation de session 

// recup du form
if(isset($_POST['email']) && isset($_POST['password'])){
    $user = new User();
    $user->setEmail($_POST['email']);
    //cryptage du MDP
    $password = hash("sha256", $_POST['password']);
    $user->setPass($password);
    // invoque methode checkUser($cnx, $objetUser);
    $user = ManagerUser::checkUser($cnx, $user);
}

if($user != null){
    // use sessions
    // server should keep session data for AT LEAST 1 hour
//    ini_set('session.gc_maxlifetime', 60);
//
//    // each client should remember their session id for EXACTLY 1 hour
//    session_set_cookie_params(60);

   $_SESSION['prenom'] = $user->getPrenom(); 
   $_SESSION['nom'] = $user->getNom();
   // !!!
   $_SESSION['id'] = session_id();
   $_SESSION['authen'] = "OK"; // Muscler la valeur pour le cas ou plusieurs personnes sur la même session
   $_SESSION['timeDebut'] = time();
   
   header("Location: index.php");
   exit(); 
}
else{
   $_SESSION['essai'] = $_SESSION['essai'] + 1;  
   if($_SESSION['essai']>3) header("Location: www.google.fr");
   else header("Location: login.php?error");
   exit();
}



