<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\FormServiceProvider;
use DateTime;


class IndexController{
	public function indexAction(Request $request, Application $app){
	
		$id = $request->attributes->get('id');

		// Conger of the current user
		$sql = "SELECT * FROM conge WHERE e_id = ?";
		$app['conges'] = $app['db']->fetchAll($sql, array($id));
		
		// Check if current user is admin
		$sql = "SELECT * FROM employee WHERE id = ? AND statut = 1";
		$admin = ($app['db']->executeQuery($sql, array($id))->rowCount() > 0)? 1 : 0;
		
		$app['pending_conges'] = array();
		if($admin){
			$sql = "SELECT * FROM conge c INNER JOIN employee e on e.id = c.e_id WHERE c.statut = 1"; // 0=refused, 1=pending, 2=accepted
			$app['pending_conges'] = $app['db']->fetchAll($sql);
		}
		
		return $app['twig']->render( // Render the page index.html.twig
			'index.html.twig',
			array(// Supply the arguments to be used in the template
				'id' => $id,
				'conges' => $app['conges'], 
				'admin' => $admin,
				'pending_conges' => $app['pending_conges']
			)
		);
	}
}