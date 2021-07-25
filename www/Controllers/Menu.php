<?php

namespace App;

use App\Core\View;
use App\Core\Helpers;

use App\Models\Menu as ModelMenu;
use App\Models\Page;
use App\Models\Article;

class Menu
{

    /**
     * Display of the Menu page from which you can add a new menu
     * The header and footer menu already exist
     * Visible pages and articles are displayed on the view so you can add them to a new menu with the checkout boxes
     */
    public function defaultAction() {
        if (!empty($_POST)) {
            if (!empty($_POST['contentMenu'])) {
                $menuToSave = new ModelMenu();

                if (!empty($_POST['id'])) {
                    $menuToSave->setId($_POST['id']);
                }
                if (!empty($_POST['name'])) {
                    $menuToSave->setName($_POST['name']);
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
        $view->assign("pages", Helpers::cleanArray($resultsPages));
        $view->assign("articles", Helpers::cleanArray($resultsArticles));
        $view->assign("formMenuCreation", $menus->buildCreationForm());
    }
}