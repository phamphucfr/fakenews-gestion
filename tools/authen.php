<?php
session_start();  // la toute première instruction obligatoire avant toute utilisation de session 

$id = session_id();


if(!(isset($_SESSION['id']) && $_SESSION['id']==$id && isset($_SESSION['authen']) && $_SESSION['authen']=="OK")){
    header("Location: login.php");
    exit();
}


