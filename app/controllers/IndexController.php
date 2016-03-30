<?php
    namespace app\controllers
    {
        use LPDR\Controller;
        use app\models\UserTable;

        class IndexController extends Controller
        {
            public function indexAction()
            {
                $userTable = new UserTable();
                $user = $userTable->findOne("login = ?", array("bobbycarotte"));

                $this->render(__CLASS__ . ":" . "index", $user);
            }

            public function aboutAction()
            {
                echo __FUNCTION__;
            }
        }
    }