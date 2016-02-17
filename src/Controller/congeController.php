<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\FormServiceProvider;
use Symfony\Component\Validator\Constraints as Assert;
use App\Model\Entity\Conge;
use DateTime;

class congeController {

    public function addAction(Request $request, Application $app) {

        $id = $request->attributes->get('id');

        $form = $app['form.factory']->createBuilder('form')
                ->add('date_debut', 'date', array(
                    'required' => true
                ))
                ->add('date_fin', 'date', array(
                    'required' => true
                ))
                ->add('commentaire', 'textarea', array(
                    'required' => false
                ))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $conge = new Conge();
            $conge->setDateDebut($data['date_debut']->format('Y-m-d H:i:s'));
            $conge->setDateFin($data['date_fin']->format('Y-m-d H:i:s'));
            $conge->setStatut(1);
            $conge->setCommentaire($data['commentaire']);
            $conge->setEmployeeId($id);
            //$conge->save($app);
            $app['repository.conge']->save($conge);

            // redirect somewhere
            return $app->redirect('../index/' . $id);
        }

        // display the form
        return $app['twig']->render('form.html.twig', array('form' => $form->createView(), 'id' => $id));
    }

    public function updtAction(Request $request, Application $app) {
        $conger_id = $request->attributes->get('cid');
        $updt_val = $request->attributes->get('updt'); // conger accepted(2)/refused(0)
        // update the conger of the employee
        $app['db']->executeUpdate(
                'UPDATE conge SET statut = ? WHERE cid = ?', array(
            $updt_val,
            $conger_id
                )
        );

        return $app->json(array('updated' => 'ok'));
    }

    public function getStatut($id) {
        $output = "En attente";

        if ($id == 2)
            $output = "conger approuver";
        if ($id == 0)
            $output = "conger refuser";

        return $output;
    }

    public function getDate($date) {
        $date = new DateTime();

        return $output;
    }

}
