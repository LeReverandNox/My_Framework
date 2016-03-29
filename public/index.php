<?php
    require_once("../lib/Tools.php");

    if (false !== Tools::getParam("page"))
    {
        $controller = Tools::getParam("page");
        require_once("../app/controllers/" .  ucfirst($controller) . "Controller.php");
    }