<?php
    namespace LPDR
    {
        class Core
        {
            public static function run()
            {
                require_once("Tools.php");

                if (false !== Tools::getParam("page"))
                {
                    $controller = Tools::getParam("page");
                    if (true === file_exists("../app/controllers/" .  ucfirst($controller) . "Controller.php"))
                    {
                        require_once("../app/controllers/" .  ucfirst($controller) . "Controller.php");
                    }
                }
            }
        }
    }