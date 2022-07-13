<?php

class Theme implements JsonSerializable{
	private $idTheme;
	private $libelle;
        
    function jsonSerialize(){
        return 
        [
            'idTheme' => $this->getIdTheme(),
            'libelle' => $this->getLibelle()
        ];
        }
	
	function __construct(){

	}
	
	function getIdTheme(){
		return $this->idTheme;
	}
	
	function setIdTheme($idTheme){
		$this->idTheme = $idTheme;	
	}
	function getLibelle(){
		return $this->libelle;
	}
	
	function setLibelle($libelle){
		$this->libelle = $libelle;	
	}
	
}


?>