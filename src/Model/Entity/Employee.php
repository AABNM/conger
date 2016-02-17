<?php

namespace App\Model\Entity;

/**
 * Employee applying for holiday
 */
class Employee {
    
    private $nom;
    private $statut;
    
    public function getNom(){
        return $this->nom;
    }
    
    public function setNom($nom){
        $this->nom = $nom;
    }
    
    public function getStatut(){
        return $this->statut;
    }
    
    public function setStatut($statut){
        $this->statut = $statut;
    }
}
