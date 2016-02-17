<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\FormServiceProvider;
use App\Model\Entity\Conge;
use DateTime;


class EmployeeController{
	public function viewAction(Request $request, Application $app){
	
		$id = $request->attributes->get('id');

		// Conger of the current user
		$conge = new Conge();
		$conge->getApproved($id, $app);
		
		
		
		return $app['twig']->render( // Render the page index.html.twig
			'employee.html.twig',
			array(// Supply the arguments to be used in the template
				'id' => $id,
				'conges' => $app['conges']
			)
		);
	}
}