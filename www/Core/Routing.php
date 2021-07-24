<?php

namespace App\Core;

use App\Core\Installer;

class Routing{

    private static $routesPath = "routes.yml";
    public $controller="";
    public $action="defaultAction";
    public $routes = [];
    public $slugs = [];


    public function __construct($uri){
        if(!Installer::checkIfEnvExist() && $uri != "/installer" && $uri != "/make-install") $this->redirectToInstaller();

        if (!file_exists(self::$routesPath)){
            die("Error : file ".self::$routesPath." don't exist.");
        }
        $this->routes = yaml_parse_file(self::$routesPath);
        //Faut vérifier qu'il y a un controller pour cette route
        if(!empty($this->routes[$uri])){
            $this->setController($this->routes[$uri]["controller"]);
            $this->setAction($this->routes[$uri]["action"]);
        }

        foreach ($this->routes as $slug=>$info) {
            $this->slugs[$info["controller"]][$info["action"]] = $slug;
        }

    }


    //PascalCase pour une class
    public function setController($controller){
        $this->controller=ucfirst(mb_strtolower($controller));
    }

    public function setAction($action){
        $this->action=$action."Action";
    }

    public function getController(){
        return $this->controller;
    }

    public function getAction(){
        return $this->action;
    }

    public function getControllerWithNamespace(){
        return "\App\\".$this->controller;
    }

    public function getMenuData(){
        return $this->routes;
    }

    public static function getListOfRoutes() {
        return yaml_parse_file(self::$routesPath);
    }

    public static function getBaseUrl() {
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
    }

    public function redirectToInstaller() {
        header('location: /installer');
        exit(0);
    }

    /*
        /list-des-utilisateurs:
          controller: Security
          action: listofusers
     */
    public function getUri($controller, $action){

        if(!empty($this->slugs[$controller]) && !empty($this->slugs[$controller][$action]))
            return $this->slugs[$controller][$action];


        die("Aucun route ne correspond à ".$controller." -> ".$action );
    }

    static function writeUrlSitemap($loc, $lastmod) {
        return '<url>
                    <loc>'.$loc.'</loc>
                    <lastmod>'.$lastmod.'</lastmod>
                </url>';
    }

    /**
     * Returns the elements to put in the sitemap.xml coming from the public roads included in the routes.yml file
     * @param $routes
     * @param $routes_exclude
     * @return string
     */
    static function getBaseRouteSitemap($routes, $routes_exclude): string
    {
        $sitemap = "";

        foreach ($routes as $key => $route) {
            if(!in_array($key, $routes_exclude) && !strpos($key, 'admin')) {
                $loc = self::getBaseUrl() . $key;
                $lastmod = date('c',time());
                //$priority = "1.0"; Impossible de déterminer une priorité pertinente sans crawler
                $sitemap .= self::writeUrlSitemap($loc, $lastmod);
            }
        }
        return $sitemap;
    }

    /**
     *
     * Returns the elements to put in the sitemap.xml coming from the routes coming from the articles and the pages created from the CMS
     * @return string
     */
    static function getDynamicSitemap(): string
    {
        $sitemap = "";

        $article = new \App\Models\Article();
        $page = new \App\Models\Page();
        $all_articles = $article->query(
            ["uri"],
            ["isDeleted" => "0"]
        );
        $all_pages = $page->query(
            ["uri"],
            ["isDeleted" => "0"]
        );

        foreach($all_articles as $article) {
            $loc = self::getBaseUrl() . $article['uri'];
            $lastmod = date('c',time());
            //$priority = "1.0"; Impossible de déterminer une priorité pertinente sans crawler
            $sitemap .= self::writeUrlSitemap($loc, $lastmod);
        }
        foreach($all_pages as $page) {
            $loc = self::getBaseUrl() . $page['uri'];
            $lastmod = date('c',time());
            //$priority = "1.0"; Impossible de déterminer une priorité pertinente sans crawler
            $sitemap .= self::writeUrlSitemap($loc, $lastmod);
        }
        return $sitemap;
    }
}
/*
if(file_exists("routes.yml")){
	$listOfRoutes = yaml_parse_file("routes.yml");
	echo "<pre>";
	print_r($listOfRoutes);
	if(!empty($listOfRoutes[$uri])
		&& !empty($listOfRoutes[$uri]["controller"])
		&& !empty($listOfRoutes[$uri]["action"])){

		$c = $listOfRoutes[$uri]["controller"]."Controller";
		$a = $listOfRoutes[$uri]["action"]."Action";
		//Est-ce que j'ai les droits, si ce n'est pas le cas erreur access denied : 403
	}else{
		die("Erreur 404");
	}
}else{
	die("Le fichier de routing n'existe pas");
}
*/