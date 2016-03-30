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
                    $params = explode("/", Tools::getParam("page"));
                    $controllerName = "app/controllers/" . ucfirst($params[0]) . "Controller";
                    $actionName = $params[1] . "Action";

                    if (true === file_exists("../" . $controllerName . ".php"))
                    {
                        require_once("../" . $controllerName . ".php");
                        $controllerName = str_replace("/", "\\", $controllerName);
                        $controller = new $controllerName();
                        $controller->$actionName();
                    }
                }
            }
        }
    }