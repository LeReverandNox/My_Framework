<?php
    require_once("../lib/Tools.php");

    if (false !== Tools::getParam("page"))
    {
        $controller = Tools::getParam("page");
        if (true === file_exists("../app/controllers/" .  ucfirst($controller) . "Controller.php"))
        {
            require_once("../app/controllers/" .  ucfirst($controller) . "Controller.php");
        }
    }