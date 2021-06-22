<?php

namespace App;

use App\Core\View;
use App\Core\Security;
use App\Core\Statistic;


class Base{

	//Must be connected
	public function dashboardAction(){
		$security = Security::getInstance();
		if(!$security->isConnected()){
            header('Location: /login');
    	}

		$statisticsPages = Statistic::getSimpleStatistics(
			[
				'Page' => [
					'label' => 'Page visibles',
					'element' => 'Page',
					'filter' => [
						'isVisible' => 1
					]
				],
				'Article' => [
					'label' => 'Articles visibles',
					'element' => 'Article',
					'filter' => [
						'isVisible' => 1
					]
				],
				'Comment' => [
					'label' => 'Commentaires postés',
					'element' => 'Comment',
					'filter' => []
				] 
			]
		);

		//Affiche moi la vue dashboard;
		$view = new View("dashboard", "back");
		$view->assign("statistics", $statisticsPages);
	}

}