<?php

namespace App\Core;

class MenuBuilder
{
    private static $_instance = null;

    private static $_menuData;
    private static $_actualUri;

    public function getMenuData(){
        return self::$_menuData;
    }
    public function getActualUri(){
        return self::$_actualUri;
    }

    private function __construct($menuData, $actualUri) {
        self::$_menuData = $menuData;
        self::$_actualUri = $actualUri;
    }

    public static function getInstance($menuData = [], $actualUri = '') {
        if(is_null(self::$_instance)) {
            self::$_instance = new MenuBuilder($menuData, $actualUri);
        }

        return self::$_instance;
    }

    public static function createMenu(){
        $menuData = self::$_menuData;
        $actualUri = self::$_actualUri;
        $menuListBuilder = [];
        $html = '';
        foreach ($menuData as $link => $data) {
            if (!empty($data['menuData'])){
                //TODO : check the min-status
                if ($data['menuData']['visible']){
                    $class = $actualUri == $link ? ' class="selected"' : '';
                    $html= '<li'.$class.'><a href="'.$link.'">'
                        .'<img src="public/images/icons/'.$data['menuData']['icon'].'.png" alt="" class="icon iconWhite"><p>'.$data['menuData']['label'].'</p></a>'
                        .'</a></li>';
                    if (array_key_exists($data['menuData']['listId'], $menuListBuilder)){
                        $menuListBuilder[$data['menuData']['listId']] .= $html;
                    }else {
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