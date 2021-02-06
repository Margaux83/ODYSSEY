<?php

namespace App\Core;

class MenuBuilder
{
    public static function createMenu($menuInfos, $actualUri){
        $menuListBuilder = [];
        $html = '';
        foreach ($menuInfos as $link => $data) {
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
        echo $html;
    }
}