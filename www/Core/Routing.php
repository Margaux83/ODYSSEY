<?php

namespace App\Core;


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
        if(!empty($this->routes[$uri])){
            $this->setController($this->routes[$uri]["controller"]);
            $this->setAction($this->routes[$uri]["action"]);
        }

        foreach ($this->routes as $slug=>$info) {
            $this->slugs[$info["controller"]][$info["action"]] = $slug;
        }

    }

    /**
     * @param $controller
     */
    public function setController($controller){
        $this->controller=ucfirst(mb_strtolower($controller));
    }

    /**
     * @param $action
     */
    public function setAction($action){
        $this->action=$action."Action";
    }

    /**
     * @return string
     */
    public function getController(){
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(){
        return $this->action;
    }

    /**
     * @return string
     */
    public function getControllerWithNamespace(){
        return "\App\\".$this->controller;
    }

    /**
     * @return array|false|mixed
     */
    public function getMenuData(){
        return $this->routes;
    }

    /**
     * @return false|mixed
     */
    public static function getListOfRoutes() {
        return yaml_parse_file(self::$routesPath);
    }

    /**
     * @return string
     */
    public static function getBaseUrl() {
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
    }

    public function redirectToInstaller() {
        header('location: /installer');
        exit(0);
    }

    /**
     * @param $controller
     * @param $action
     * @return mixed
     */
    public function getUri($controller, $action){

        if(!empty($this->slugs[$controller]) && !empty($this->slugs[$controller][$action]))
            return $this->slugs[$controller][$action];


        die("Aucun route ne correspond à ".$controller." -> ".$action );
    }

    /**
     * @param $loc
     * @param $lastmod
     * @return string
     */
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
            $sitemap .= self::writeUrlSitemap($loc, $lastmod);
        }
        foreach($all_pages as $page) {
            $loc = self::getBaseUrl() . $page['uri'];
            $lastmod = date('c',time());
            $sitemap .= self::writeUrlSitemap($loc, $lastmod);
        }
        return $sitemap;
    }
}