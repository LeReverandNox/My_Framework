<?php
    namespace LPDR
    {
        class Core
        {
            public static function run()
            {
                try {
                    self::registerAutoload();
                    self::loadConfig();

                    if (false !== Tools::getParam("page"))
                    {
                        $params = explode("/", Tools::getParam("page"));
                        $controllerName = "app\controllers\\" . ucfirst($params[0]) . "Controller";
                        $actionName = $params[1] . "Action";

                        if (class_exists($controllerName)) {
                            $controller = new $controllerName();
                        } else {
                            throw new \Exception(404);
                        }

                        if (method_exists($controller, $actionName)) {
                            $controller->$actionName();
                        } else {
                            throw new \Exception(500);
                        }
                    }
                } catch (\Exception $e) {
                    if ($e->getMessage() === "404") {
                        header("HTTP/1.1 404 Not Found");
                    }
                    if ($e->getMessage() === "500") {
                        header("HTTP/1.1 500 Internal Server Error");
                    }
                }
            }

            private static function registerAutoload()
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
            private static function loadConfig()
            {
                $ini = ".." . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "config.ini";
                if (true === file_exists($ini))
                {
                    $configs = parse_ini_file($ini, true);
                    $modelConf = $configs["model"];

                    Model::setHostname($modelConf["hostname"]);
                    Model::setPort($modelConf["port"]);
                    if (true === isset($modelConf["socket"]))
                    {
                        Model::setSocket($modelConf["socket"]);
                    }
                    Model::setUsername($modelConf["username"]);
                    Model::setPassword($modelConf["password"]);
                    Model::setDbname($modelConf["dbname"]);
                }
            }
        }
    }