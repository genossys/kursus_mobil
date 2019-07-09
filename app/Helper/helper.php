<?php

function set_active($path)
{
    $name = Route::currentRouteName();
    if($name == $path){
   return 'active';
    }else{
        return '';
    }

}

function menu_open($path){
    $name = Route::currentRouteName();
    if($name == $path){
   return 'menu-open';
    }else{
        return '';
    }
}


?>
