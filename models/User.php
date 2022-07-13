<?php

class User {
    private $idUser;
    private $nom;
    private $prenom;
    private $email;
    private $pass;
    
    function __construct() {
        
    }
    
    function getIdUser(){
        return $this->idUser;
    }

    function getNom(){
        return $this->nom;
    }

    function getPrenom(){
        return $this->prenom;
    }

    function getEmail(){
        return $this->email;
    }

    function getPass(){
        return $this->pass;
    }

    function setIdUser($idUser){
        $this->idUser = $idUser;
    }

    function setNom($nom){
        $this->nom = $nom;
    }

    function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function setPass($pass){
        $this->pass = $pass;
    }


}
