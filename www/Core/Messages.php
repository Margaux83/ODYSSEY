<?php


namespace App\Core;


class Messages
{

    public static function getFlashMessage($class,$message)
    {
        return "<div class=\".$class.\">".$message."</div>";
    }

    /*public static function setFlashMessage($class,$message){
        $this->class=$class;
    }*/
}