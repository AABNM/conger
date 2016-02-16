<?php

namespace App\Model\Entity;

/**
 * Entity Conge
 *
 */
class Conge {
    
    private $date_debut;
    private $date_fin;
    private $statut;
    private $commentaire;
    private $employee_id;
    
    function __construct($date_debut, $date_fin, $statut, $commentaire, $employee_id) {
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->statut = $statut;
        $this->commentaire = $commentaire;
        $this->employee_id = $employee_id;
    }
    
    public function getDateDebut(){
        return $this->date_debut;
    }
    
    public function setDateDebut($date_debut){
        $this->date_debut = $date_debut;
    }
    
    public function getDateFin(){
        return $this->date_fin;
    }
    
    public function setDateFin($date_fin){
        $this->date_fin = $date_fin;
    }
    
    public function getStatut(){
        return $this->statut;
    }
    
    public function setStatut($statut){
        $this->statut = $statut;
    }
    
    public function getCommentaire(){
        return $this->commentaire;
    }
    
    public function setCommentaire($commentaire){
        $this->commentaire = $commentaire;
    }
    
    public function getEmployeeId(){
        return $this->employee_id;
    }
    
    public function setEmployeeId($employee_id){
        $this->employee_id = $employee_id;
    }    
    
}
