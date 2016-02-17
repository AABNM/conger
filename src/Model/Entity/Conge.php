<?php

namespace App\Model\Entity;

use Silex\Application;

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
    
    /*
    **	Save the conge application 
    */
    public function save(Application $app){
    	// insert into conge
	    $app['db']->executeUpdate(
           	'INSERT INTO conge (date_debut, date_fin, statut, commentaire, e_id) VALUES (?, ?, ?, ?, ?)',
           	array(
               	$this->date_debut,
               	$this->date_fin,
               	$this->statut,
               	$this->commentaire,
               	$this->employee_id
           	)
        );
    }
    
    /*
    **  Get approved conger from employee id
    */
    public function getApprovedConger($id, Application $app){
    	$sql = "SELECT * FROM conge WHERE e_id = ? AND statut = 2"; // 2=accepted
		$app['conges'] = $app['db']->fetchAll($sql, array($id));
		
		$conge = buildConge($app['conges']);
    }
    
    /*
    ** Return formatted conge properties
    */
    public function buildConge($congeData){
    	
    }
    
}
