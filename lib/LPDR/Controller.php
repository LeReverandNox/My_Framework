<?php
    namespace LPDR
    {
        abstract class Controller
        {
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
        }
    }