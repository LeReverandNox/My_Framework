<?php
    namespace app\controllers
    {
        use LPDR\Controller;
        use app\models\UserTable;

        class IndexController extends Controller
        {
            public function indexAction()
            {
                $u = new UserTable();
                $this->render(__CLASS__ . ":" . "index", array("username" => "Marie"));
            }

            public function aboutAction()
            {
                echo __FUNCTION__;
            }
        }
    }