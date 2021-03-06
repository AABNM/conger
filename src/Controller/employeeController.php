<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\FormServiceProvider;
use App\Model\Entity\Conge;
use DateTime;

class EmployeeController {

    public function viewAction(Request $request, Application $app) {

        $id = $request->attributes->get('id');

        $conges = $app['repository.conge']->find($id, 2);

        return $app['twig']->render(// Render the page index.html.twig
                        'employee.html.twig', array(// Supply the arguments to be used in the template
                            'id' => $id,
                            'conges' => $conges
                        )
        );
    }

}
