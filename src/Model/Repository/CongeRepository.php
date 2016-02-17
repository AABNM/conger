<?php

namespace App\Model\Repository;

use Doctrine\DBAL\Connection;
use App\Model\Entity\Conge;

/**
 * Conge Repository
 */
class CongeRepository {

    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db) {
        $this->db = $db;
    }

    /**
     * Saves the artist to the database.
     *
     * @param \App\Model\Entity\Conge $conge
     */
    public function save($conge) {
        $congeData = array(
            'date_debut' => $conge->getDateDebut(),
            'date_fin' => $conge->getDateFin(),
            'commentaire' => $conge->getCommentaire(),
            'statut' => $conge->getStatut(),
            'e_id' => $conge->getEmployeeId()
        );

        $this->db->insert('conge', $congeData);
    }

    /**
     * Returns a collection of conger matching the employee id with the respective statut passed
     *
     * @param integer $id
     *
     * @return App\Model\Entity\Conge|false An entity object if found, false otherwise.
     */
    public function find($id, $statut = false) {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
                ->select('c.*')
                ->from('conge', 'c')
                ->where('c.e_id = :e_id')
                ->setParameter('e_id', $id);

        if ($statut)
            $queryBuilder->andWhere('c.statut = :statut')->setParameter('statut', $statut);

        $statement = $queryBuilder->execute();
        $congesData = $statement->fetchAll();

        $conges = array();
        foreach ($congesData as $congeData) {
            $congeId = $congeData['cid'];
            $conges[$congeId] = $this->buildConge($congeData);
        }

        return $conges;
    }

    /**
     * 
     */
    public function isAdmin($id) {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
                ->select('e.*')
                ->from('employee', 'e')
                ->where('e.id = :eid')
                ->andWhere('e.statut = :statut')
                ->setParameter('eid', $id)
                ->setParameter('statut', 1);

        $statement = $queryBuilder->execute()->rowCount();
        $isAdmin = ($statement > 0)? TRUE : FALSE;
        
        return $isAdmin;
    }

    /**
     * Returns a collection of pending conger only if the employee is an admin
     *
     * @param integer $id
     *
     * @return App\Model\Entity\Conge|false An entity object if found, false otherwise.
     */
    public function getPendingConges($id, $statut = false) {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
                ->select('*')
                ->from('conge', 'c')
                ->innerJoin('c', 'employee', 'e', 'e.id = c.e_id')
                ->where('c.statut = :statut')
                ->setParameter('statut', 1);

        $statement = $queryBuilder->execute();
        $congesData = $statement->fetchAll();

        $conges = array();
        foreach ($congesData as $congeData) {
            $congeId = $congeData['cid'];
            $conges[$congeId] = $this->buildConge($congeData);
            $conges[$congeId]->cid = $congeData['cid'];
            $conges[$congeId]->nom = $congeData['nom'];
        }

        return $conges;
    }

    /**
     * Instantiates a conge entity and sets its properties using db data.
     *
     * @param array $congeData
     *   The array of db data.
     *
     * @return App\Model\Entity\Conge
     */
    protected function buildConge($congeData) {

        $conge = new Conge();
        $conge->setDateDebut($congeData['date_debut']);
        $conge->setDateFin($congeData['date_fin']);
        $conge->setCommentaire($congeData['commentaire']);
        $conge->setStatut($congeData['statut']);

        // pass though temporary class to get values as we have set property as private
        $temp = new \stdClass();
        $temp->date_debut = $conge->getDateDebut();
        $temp->date_fin = $conge->getDateDebut();
        $temp->statut = $conge->getStatutText();
        $temp->commentaire = $conge->getCommentaire();

        return $temp;
    }

}
