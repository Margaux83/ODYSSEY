<?php


namespace App\Core;
use App\Models\Article;
use App\Models\User;
use App\Models\Page;
use App\Models\Menu;
use App\Models\Comment;

class FrontPage extends Database
{
    private static $_themeSelected;
    private static $_actualUri;

    /**
     * @return string
     * Function that return the selected theme in the CMS
     */
    public static function getTemplateCss() {
        return 'themes/'.Template::getSelectedTheme().'front.css';
    }

    /**
     * @param null $idArticle
     * @return string
     * Return the comments and the number of comment added to an article, the article's id is passed in parameter
     */
    public static function getCommentarySection($idArticle = null) {
        if (empty($idArticle)) return '';

        $comment = new Comment();
        $resultComments = $comment->query(['id', 'content', 'id_User', 'id_Comment'], ['id_article' => $idArticle, 'isDeleted'=>0]);

        $html = '<section class="commentsSection"><h2>Commentaires ('
            . count($resultComments)
            . ')</h2>'
            . Form::showForm($comment->buildFormPostFront($idArticle), false)
            . '<ul>';

        if (!empty($resultComments)) {
            $user = new User();
            foreach ($resultComments as $key => $resultComment) {
                $userSelected = $user->query(['firstname', 'lastname'], ['id' => $resultComment['id_User']])[0];
                $html .= '<li>'
                    . '<p class="commentUser">' . $userSelected['firstname'] . ' ' . $userSelected['lastname'] . '</p>'
                    . '<p class="commentContent">' . $resultComment['content'] . '</p>'
                    . '</li>';
            }
        }else {
            $html .= '<p style="text-align: center; font-style: italic;">Soyez le premier à écrire un commentaire</p>';
        }

        $html .= '</ul></section>';
        return $html;
    }

    /**
     * @param string $nameMenu
     * @return string
     * Return the menu on the front page
     */
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

    /**
     * @param $uri
     * Return the content of the article or the page in order to display them on the front page
     */
    public static function findContentToShow($uri) {
        self::$_actualUri = $uri;

        if (Template::searchPageSelectedTheme($uri)) {
            $view = new View("front_home", "front", Template::searchPageSelectedTheme($uri));
        }else {
            if ($uri === '/'){
                $view = new View("front_home", "front", Template::searchPageSelectedTheme('home'));
                $view->assign("title", 'Accueil');
            }elseif (strpos($uri, 'article')) {
                $article = new Article();
                $resultArticle = $article->query(
                    ['id', 'title', 'content', 'description'],
                    [
                        'uri' => $uri,
                        'isVisible' => 1
                    ]
                );
                if ($resultArticle) {
                    $view = new View("front_page", "front");
                    $view->assign("idArticle", $resultArticle[0]['id']);
                    $view->assign("title", $resultArticle[0]['title']);
                    $view->assign("description", $resultArticle[0]['description']);
                    $view->assign("content", stripslashes($resultArticle[0]['content']));
                }else {
                    Error::errorPage(404, 'L\'article n\'existe pas');
                }
            }else {
                $page = new Page();
                $resultPage = $page->query(
                    ['id', 'title', 'content', 'description'],
                    [
                        'uri' => $uri,
                        'isVisible' => 1
                        ]
                );
    
                if ($resultPage) {
                    $view = new View("front_page", "front");
                    $view->assign("idArticle", false);
                    $view->assign("title", $resultPage[0]['title']);
                    $view->assign("description", $resultPage[0]['description']);
                    $view->assign("content", stripslashes($resultPage[0]['content']));
                }else {
                    Error::errorPage(404, 'La page n\'existe pas');
                }
            }
        }
    }
}