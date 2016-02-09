<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\FormServiceProvider;
use DateTime;


class EmployeeController{
	public function viewAction(Request $request, Application $app){
	
		$id = $request->attributes->get('id');

		// Conger of the current user
		$sql = "SELECT * FROM conge WHERE e_id = ? AND statut = 2"; // 2=accepted
		$app['conges'] = $app['db']->fetchAll($sql, array($id));
		
		
		return $app['twig']->render( // Render the page index.html.twig
			'employee.html.twig',
			array(// Supply the arguments to be used in the template
				'id' => $id,
				'conges' => $app['conges']
			)
		);
	}
}