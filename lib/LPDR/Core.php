<?php
    namespace LPDR
    {
        class Core
        {
            public static function run()
            {
                self::registerAutoload();

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

            public static function registerAutoload()
            {
                spl_autoload_register(
                    function ($class) {
                        $class = str_replace("\\", "/", $class);

                        if (true === file_exists("../" . $class . ".php"))
                        {
                            require_once("../" . $class . ".php");
                        }
                        if (true === file_exists("../lib/" . $class . ".php"))
                        {
                            require_once("../lib/" . $class . ".php");
                        }
                    }
                );
            }
        }
    }