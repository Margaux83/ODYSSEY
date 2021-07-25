<?php

namespace App;

use App\Core\View;
use App\Core\Security;
use App\Core\Statistic;
use App\Core\ListQuery;
use App\Core\Routing;

class Base{

    public function defaultAction() {
        header('location: /admin/dashboard');
    }

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

    public function sitemapAction() {
        header('Content-Type: text/xml; charset=UTF-8');
        $routes = Routing::getListOfRoutes();
        $routes_exclude = [
            "/sitemap.xml",
            "/verification",
            "/forgotpasswordconfirm",
            "/newpasswordconfirm",
            "/logout",
            "/actionfront/postcommentfront",
            "/installer"
        ];
        $sitemap = "";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        $sitemap .= Routing::getBaseRouteSitemap($routes, $routes_exclude);
        $sitemap .= Routing::getDynamicSitemap();

        $sitemap .= '</urlset>';
        echo $sitemap;
	}
}