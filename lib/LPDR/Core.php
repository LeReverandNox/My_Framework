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

                    $params = explode("/", Tools::getParam("page"));

                    if (true === empty($params[0])) {
                        $controllerName = "app\controllers\\" . ucfirst(_DEFAULT_CONTROLLER_) . "Controller";
                    } else {
                        $controllerName = "app\controllers\\" . ucfirst($params[0]) . "Controller";
                    }
                    if (true === empty($params[1])) {
                        $actionName = _DEFAULT_ACTION_ . "Action";
                    } else {
                        $actionName = $params[1] . "Action";
                    }

                    if (class_exists($controllerName)) {
                        $controller = new $controllerName();
                    } else {
                        throw new \Exception(404);
                    }

                    self::parseParams($controller, $params);

                    if (method_exists($controller, $actionName)) {
                        $controller->$actionName();
                    } else {
                        throw new \Exception(500);
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
                    $constConf = $configs["const"];

                    Model::setHostname($modelConf["hostname"]);
                    Model::setPort($modelConf["port"]);
                    if (false === empty($modelConf["socket"]))
                    {
                        Model::setSocket($modelConf["socket"]);
                    }
                    Model::setUsername($modelConf["username"]);
                    Model::setPassword($modelConf["password"]);
                    Model::setDbname($modelConf["dbname"]);

                    foreach ($constConf as $key => $value)
                    {
                        define($key, $value);
                    }
                }
            }

            private static function parseParams($controller, $params)
            {
                if (count($params) > 2)  {
                    for ($i = 2; $i < count($params); $i += 2)
                    {
                        if (true === isset($params[$i + 1]) && false === empty($params[$i + 1])) {
                            $key = $params[$i];
                            $value = $params[$i +1];
                            $controller->setParam($key, $value);
                        }
                    }
                }
            }
        }
    }