<?php

namespace App;

use App\Core\View;
use App\Core\Security;
use App\Core\Statistic;
use App\Core\ListQuery;


class Base{

	//Must be connected
	public function dashboardAction(){
		$security = Security::getInstance();
		if(!$security->isConnected()){
            header('Location: /login');
    	}

		$statisticsPages = Statistic::getSimpleStatistics(
			[
				[
					'label' => 'Page visibles',
					'element' => 'Page',
					'filter' => [
						'isVisible' => 1
					]
				],
				[
					'label' => 'Articles visibles',
					'element' => 'Article',
					'filter' => [
						'isVisible' => 1
					]
				],
				[
					'label' => 'Commentaires postés',
					'element' => 'Comment',
					'filter' => []
				] 
			]
		);

		$listComments = ListQuery::getSimpleList(
			[
				'element' => 'Comment',
				'columns' => [
					'id_User' => [
						'label' => 'Utilisateurs',
						'size' => 2,
						'combo' => [
							'element' => 'User',
							'columns' => ['firstname', 'lastname'],
							'filterKey' => 'id'
						]
					],
					'content' => [
						'label' => 'Commentaires',
						'size' => 3
					],
				]
			]
		);

		//Affiche moi la vue dashboard;
		$view = new View("dashboard", "back");
		$view->assign("statistics", $statisticsPages);
		$view->assign("comments", $listComments);
	}

}

