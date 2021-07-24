<?php

namespace App;

use App\Core\View;
use App\Models\Menu as ModelMenu;
use App\Models\Page;
use App\Models\Article;

class Menu
{
    public function defaultAction() {
        if (!empty($_POST)) {
            if (!empty($_POST['contentMenu'])) {
                $menuToSave = new ModelMenu();

                if (!empty($_POST['id'])) {
                    $menuToSave->setId($_POST['id']);
                }
                if (!empty($_POST['name'])) {
                    $menuToSave->setName(htmlspecialchars(addslashes($_POST['name'])));
                }
                $menuToSave->setContentMenu($_POST['contentMenu']);
                $menuToSave->setIsDeleted(0);
                $menuToSave->save();
                $_SESSION['alert']['success'][] = 'Le menu a bien été enregistré !';
            }
        }

        $menus = new ModelMenu();
        $resultsMenus = $menus->query(['id', 'name', 'contentMenu']);

        $pages = new Page();
        $resultsPages = $pages->query(['id', 'title', 'uri'], ['isVisible' => 1]);
        $articles = new Article();
        $resultsArticles = $articles->query(['id', 'title', 'uri'], ['isVisible' => 1]);

        $view = new View("Menu/list_menus", "back");
        if (!empty($menuToSave)) {
            $view->assign("menuSelected", $menuToSave->getId() ?? '');
        }
        $view->assign("menus", $resultsMenus);
        $view->assign("pages", $resultsPages);
        $view->assign("articles", $resultsArticles);
        $view->assign("formMenuCreation", $menus->buildCreationForm());
    }
}