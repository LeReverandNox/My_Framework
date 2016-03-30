<?php
    namespace app\controllers
    {
        use LPDR\Controller;

        class IndexController extends Controller
        {
            public function indexAction()
            {
                $this->render(__CLASS__ . ":" . "index", array("username" => "Marie"));
            }

            public function aboutAction()
            {
                echo __FUNCTION__;
            }
        }
    }