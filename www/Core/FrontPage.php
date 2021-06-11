<?php


namespace App\Core;
use App\Core\View;
use App\Core\Error;
use App\Models\Page;

class FrontPage extends Database
{
    private static $_themeSelected = 'theme_classic/';
    private static $_actualUri;

    public static function getTemplateCss() {
        return self::$_themeSelected.'front.css';
    }

    public static function getFrontMenu() {
        $page = new Page();
        $resultPage = $page->query(
            ['title', 'uri'],
            [
                'isVisible' => 1
            ]
        );

        $html = '<ul>'
            . '<li class="'.(self::$_actualUri === '/' ? 'selected' : '').'"><a href="/">Accueil</a></li>';
        foreach ($resultPage as $key => $value) {
            $html .= '<li class="'.($value['uri'] === self::$_actualUri ? 'selected' : '').'"><a href="'.$value['uri'].'">'.$value['title'].'</a></li>';
        }
        $html .= '<li class="'.(self::$_actualUri === '/contact' ? 'selected' : '').'"><a href="/contact">Contact</a></li>'
            .'</ul>';
        return $html;
    }

    public static function findContentToShow($uri) {
        self::$_actualUri = $uri;
        if ($uri === '/'){
            $view = new View("front_home", "front");
        }elseif (strpos($uri, 'article')) {
            echo $uri;
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