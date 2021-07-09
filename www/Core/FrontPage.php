<?php


namespace App\Core;
use App\Models\Article;
use App\Core\View;
use App\Core\Error;
use App\Models\Page;
use App\Models\Menu;

class FrontPage extends Database
{
    private static $_themeSelected = 'theme_classic/';
    private static $_actualUri;

    public static function getTemplateCss() {
        return self::$_themeSelected.'front.css';
    }

    public static function getFrontMenu($nameMenu = '') {
        $menu = new Menu();
        $page = new Page();
        $article = new Article();

        $menuData = $menu->query(['contentMenu'], ['name' => $nameMenu])[0];

        //Adding the home page
        $html = '<ul>'
            . '<li class="'.(self::$_actualUri === '/' ? 'selected' : '').'"><a href="/">Accueil</a></li>';

        if (!empty($menuData)) {
            $contentMenu = json_decode($menuData['contentMenu'], true);
            foreach ($contentMenu as $key => $value) {
                switch ($value['object']) {
                    case 'Page':
                        $pageData = $page->query(['uri', 'title'], ['id' => $value['id']]);
                        if (!empty($pageData)) {
                            $html .= '<li class="'.($pageData[0]['uri'] === self::$_actualUri ? 'selected' : '').'"><a href="'. $pageData[0]['uri'].'">'. $pageData[0]['title'] .'</a></li>';
                        }
                        break;
                    case 'Article':
                        $articleData = $article->query(['uri', 'title'], ['id' => $value['id']]);
                        if (!empty($articleData)) {
                            $html .= '<li class="'.($articleData[0]['uri'] === self::$_actualUri ? 'selected' : '').'"><a href="'. $articleData[0]['uri'].'">'. $articleData[0]['title'] .'</a></li>';
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        //Adding the contact page
        $html .= '<li class="'.(self::$_actualUri === '/contact' ? 'selected' : '').'"><a href="/contact">Contact</a></li>'
            .'</ul>';
        
        return $html;
    }

    public static function findContentToShow($uri) {
        self::$_actualUri = $uri;
        if ($uri === '/'){
            $view = new View("front_home", "front");
        }elseif (strpos($uri, 'article')) {
            $article = new Article();
            $resultArticle = $article->query(
                ['title', 'content'],
                [
                    'uri' => $uri,
                    'isVisible' => 1
                ]
            );
            if ($resultArticle) {

                $view = new View("front_page", "front");
                $view->assign("title", $resultArticle[0]['title']);
                $view->assign("content", $resultArticle[0]['content']);
            }else {
                Error::errorPage(404, 'L\'article n\'existe pas');
            }
        }else {
            $page = new Page();
            $resultPage = $page->query(
                ['title', 'content'],
                [
                    'uri' => $uri,
                    'isVisible' => 1
                    ]
            );

            if ($resultPage) {
                $view = new View("front_page", "front");
                $view->assign("title", $resultPage[0]['title']);
                $view->assign("content", $resultPage[0]['content']);
            }else {
                Error::errorPage(404, 'La page n\'existe pas');
            }
        }
    }
}