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
                    $controllerName = "app\controllers\\" . ucfirst($params[0]) . "Controller";
                    $actionName = $params[1] . "Action";

                    $controller = new $controllerName();
                    $controller->$actionName();
                }
            }

            public static function registerAutoload()
            {
                spl_autoload_register(
                    function ($class) {
                        $class = ltrim($class, "\\");
                        $file  = '';
                        $namespace = '';
                        if ($lastNsPos = strrpos($class, '\\')) {
                            $namespace = substr($class, 0, $lastNsPos);
                            $class = substr($class, $lastNsPos + 1);
                            $file  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
                        }
                        $file .= str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';

                        if (true === file_exists(".." . DIRECTORY_SEPARATOR . $file))
                        {
                            require_once(".." . DIRECTORY_SEPARATOR . $file);
                        }
                        if (true === file_exists(".." . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . $file))
                        {
                            require_once(".." . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . $file);
                        }
                    }
                );
            }
        }
    }