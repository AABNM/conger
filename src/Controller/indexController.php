<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\FormServiceProvider;
use DateTime;

class IndexController {

    public function indexAction(Request $request, Application $app) {

        $id = $request->attributes->get('id');

        // Conger of the current user
        $conges = $app['repository.conge']->find($id);

        // Check if current user is admin
        $admin = $app['repository.conge']->isAdmin($id);

        $pending_conges = array();
        if ($admin) {
            $pending_conges = $app['repository.conge']->getPendingConges($id);
        }

        return $app['twig']->render(// Render the page index.html.twig
                'index.html.twig', array(// Supply the arguments to be used in the template
                    'id' => $id,
                    'conges' => $conges,
                    'admin' => $admin,
                    'pending_conges' => $pending_conges
                )
        );
    }

}
