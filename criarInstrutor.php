<?php
include "helper_login.php";

    $view = file_get_contents( "views/criarInstrutor.tmpl" );

    $menu = include "menu.php";
    $view = str_replace("<@MENU>", $menu, $view);

    print($view);
?>