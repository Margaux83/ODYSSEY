<?php


namespace App;

use App\Core\FormBuilder;
use App\Core\Security;
use App\Core\View;
use App\Core\Database;

use App\Models\Menus;

class MenuManagement
{

    public function defaultAction()
    {


        $security = Security::getInstance();
        //Vérifie si l'utilisateur est connecté, sinon on le redirige sur la page de login
        if (!$security->isConnected()) {
            header('Location: /login');
        }

        $menu = new Menus();
        
        
        //Affiche la vue pour ajouter un article
        $view = new View("menuManagement", "back");

      //  echo "<pre>";

      /*  var_dump($menu->buildFormMenu());
        echo "ok";
        die(); 
      */

        //Création du formBuilder des articles
        $form = $menu->buildFormMenu();
        $view->assign("form", $form);

        //On vérifie si des données sont bien envoyées
        
            if (!empty($_POST)) {

                $errors = FormBuilder::validator($_POST, $form);
                //On vérifie s'il y a des erreurs
                if (empty($errors)) {
                    //S'il n'y a pas d'erreurs, on envoie les données dans la requête pour ajouter l'article
                    $menu->setName(htmlspecialchars(addslashes($_POST['name'])));
                    $menu->setOrderMenu(1);
                    $menu->setIsDeleted(0);


                    $menu->save();

                    $_SESSION['alert']['success'][] = 'Le menu a été crée';

                    
                } else {
                    //S'il y a des erreurs, on prépare leur affichage
                    $_SESSION['alert']['danger'][] = $errors[0];

                }


            }
        
        

    }

    

}

/*
Odyssey

Mon projet annuel Web

    Tableau de bord

    Articles
        Ajouter un article
        Modifier un article

    Utilisateurs

    Commentaires

    Templates

    Gestion du menu

    Newsletter

    Accès au site

    Paramètres

Gestion du menu
Menu
Créez votre premier menu ci-dessous.
Ajouter des éléments de menu
Structure de menu
Nom du menu

Donnez à votre menu un nom, puis cliquez sur « Créer le menu ».
Réglages du menu
Afficher l’emplacement
Veuillez choisir un titre pour votre menu

Fatal error
: Uncaught PDOException: SQLSTATE[42S02]: Base table or view not found: 1146 Table 'odyssey.ody_MenuManagement' doesn't exist in /var/www/html/Core/Database.php:74 Stack trace: #0 /var/www/html/Core/Database.php(74): PDO->prepare('INSERT INTO ody...') #1 /var/www/html/Controllers/Menumanagement.php(56): App\Core\Database->save() #2 /var/www/html/index.php(45): App\MenuManagement->defaultAction() #3 {main} thrown in
/var/www/html/Core/Database.php
on line
74



Odyssey

Mon projet annuel Web

    Tableau de bord

    Articles
        Ajouter un article
        Modifier un article

    Utilisateurs

    Commentaires

    Templates

    Gestion du menu

    Newsletter

    Accès au site

    Paramètres

Gestion du menu
Menu
Créez votre premier menu ci-dessous.
Ajouter des éléments de menu
Structure de menu
Nom du menu

Donnez à votre menu un nom, puis cliquez sur « Créer le menu ».
Réglages du menu
Afficher l’emplacement

Notice: Undefined variable: form in /var/www/html/Views/menuManagement_view.php on line 56

Warning: Invalid argument supplied for foreach() in /var/www/html/Core/FormBuilder.php on line 52

Fatal error
: Uncaught Error: Call to undefined method App\Models\Menus::buildFormMenu() in /var/www/html/Controllers/Menumanagement.php:40 Stack trace: #0 /var/www/html/index.php(45): App\MenuManagement->defaultAction() #1 {main} thrown in
/var/www/html/Controllers/Menumanagement.php
on line
40


*/
