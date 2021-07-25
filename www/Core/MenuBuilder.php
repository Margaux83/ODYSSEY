<?php

namespace App\Core;

use App\Models\Role;
use App\Models\User;

class MenuBuilder
{
    private static $_instance = null;

    private static $_menuData;
    private static $_actualUri;

    /**
     * @return mixed
     */
    public function getMenuData(){
        return self::$_menuData;
    }

    /**
     * @return mixed
     */
    public function getActualUri(){
        return self::$_actualUri;
    }

    /**
     * MenuBuilder constructor.
     * @param $menuData
     * @param $actualUri
     */
    private function __construct($menuData, $actualUri) {
        self::$_menuData = $menuData;
        self::$_actualUri = $actualUri;
    }

    /**
     * @return bool
     */
    public static function needToBeConnected() {
        $pageInfo = self::getActualPageInfo();
        if (!empty($pageInfo['freeAccess'])){
            return !(self::getActualPageInfo()['freeAccess']);
        }
        return true;
    }

    /**
     * @return mixed
     */
    public static function getActualPageInfo() {
        $menuData = self::getMenuData();
        if (!empty($menuData)){
            $actualUri = self::getActualUri();
            $actualPageInfo = $menuData[$actualUri];
            $actualPageInfo['uri'] = $actualUri;
            return $actualPageInfo;
        }
    }

    /**
     * @param array $menuData
     * @param string $actualUri
     * @return MenuBuilder|null
     */
    public static function getInstance($menuData = [], $actualUri = '') {
        if(is_null(self::$_instance)) {
            self::$_instance = new MenuBuilder($menuData, $actualUri);  

        }

        return self::$_instance;
    }

    /**
     * TODO : Mettre un commentaire d'explication
     */
    public static function createMenu(){
        $perms = Security::getPermsFromConnectedUser() ?? [];

        $menuData = self::$_menuData;

        $actualUri = self::$_actualUri;
        $menuListBuilder = [];
        $html = '';
        foreach ($menuData as $link => $data) {
            if (!empty($data['menuData'])){
                //TODO : check the min-status
                if ($data['menuData']['visible'] 
                    && (
                        array_key_exists("all_perms", $perms) 
                        || array_key_exists($link, $perms)
                        || $link === '/admin/dashboard'
                        || $link === '/'
                    )) {
                    $subSectionSelected = false;

                    //Create the sub-menu
                    $htmlChildren = '';
                    if (!empty($data['menuData']['children'])) {
                        $htmlChildren = '<ul>';
                        foreach ($data['menuData']['children'] as $id => $linkChild) {
                            if (array_key_exists("all_perms", $perms) 
                                || array_key_exists($linkChild, $perms)) {
                                if ($actualUri === $linkChild) {
                                    $subSectionSelected = true;
                                }
                                $classChildren = $actualUri == $linkChild ? ' class="selected"' : '';
                                $htmlChildren .= '<li' . $classChildren . '><a href="' . $linkChild . '">' . $menuData[$linkChild]['label'] . '</li>';
                            }
                        }
                        $htmlChildren .= '</ul>';
                    }

                    $class = ' class="'
                        . ($actualUri == $link ? 'selected ' : '')
                        . ($subSectionSelected ? 'subChildrenSelected ' : '')
                        . '"';

                    $html = '<li' . $class . '><a href="' . $link . '">'
                        . '<img src="' . Routing::getBaseUrl() . '/public/images/icons/' . $data['menuData']['icon'] . '.png" alt="" class="icon iconWhite"><p>' . $data['label'] . '</p></a>'
                        . '</a>';

                    //Adding the sub-menu
                    $html .= $htmlChildren;

                    $html .= '</li>';
                    if (array_key_exists($data['menuData']['listId'], $menuListBuilder)) {
                        $menuListBuilder[$data['menuData']['listId']] .= $html;
                    } else {
                        $menuListBuilder[$data['menuData']['listId']] = $html;
                    }
                }
            }
        }

        $html = '';
        foreach ($menuListBuilder as $listId => $htmlValue) {
            $html.= '<ul id="'.$listId.'">'.$htmlValue.'</ul>';
        }

        $htmlMenu = '<nav id="back-mainPage-menu" class="d-none d-lg-flex">'
            . $html . '</nav>'
            . '<nav id="back-mainPage-menuResponsive" class="d-block d-lg-none hidden">'
            . $html . '</nav>';
        echo $htmlMenu;
    }
}