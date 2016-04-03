<?php
    namespace LPDR
    {
        abstract class Controller
        {
            protected $params = array();

            public function setParam($key, $value)
            {
                $this->params[$key] = $value;
            }
            public function getParam($paramName)
            {
                if (true === isset($this->params[$paramName])) {
                    return $this->params[$paramName];
                } else {
                    return false;
                }
            }

            /*
            ** Ancienne methode render pour les vues dynamiques, avant d'implémenter Twig
            public function render($view, $items = null)
            {
                $params = explode(":", $view);
                $controllerName = explode("\\", $params[0]);
                $controllerName = $controllerName[count($controllerName) - 1];
                $viewFilename = $params[1];

                $path = (".." . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $controllerName . DIRECTORY_SEPARATOR . $viewFilename .".html");
                $file = file($path);
                $filecontent = implode("", $file);

                ob_start();
                echo $filecontent;

                $buffer = ob_get_contents();
                foreach ($items as $key => $value)
                {
                    $buffer = str_replace("{{ " . $key . " }}", $value, $buffer);
                }
                ob_clean();

                echo $buffer;
            }
            */
            public function render($view, $items = null)
            {
                $params = explode(":", $view);
                $controllerName = explode("\\", $params[0]);
                $controllerName = $controllerName[count($controllerName) - 1];
                $viewFolder = (".." . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $controllerName);
                $viewFilename = $params[1] . ".html";

                $loader = new \Twig_Loader_Filesystem($viewFolder);
                $twig = new \Twig_Environment($loader);

                echo $twig->render($viewFilename, $items);
            }
        }
    }