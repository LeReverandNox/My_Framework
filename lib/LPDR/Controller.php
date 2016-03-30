<?php
    namespace LPDR
    {
        abstract class Controller
        {
            public function render($view)
            {
                $params = explode(":", $view);
                $controllerName = explode("\\", $params[0]);
                $controllerName = $controllerName[count($controllerName) - 1];

                $viewFilename = rtrim($params[1], "Action");

                include_once (".." . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $controllerName . DIRECTORY_SEPARATOR . $viewFilename .".html");
            }
        }
    }