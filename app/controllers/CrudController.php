<?php
    namespace app\controllers
    {
        use LPDR\Controller;
        use app\models\UserTable;
        use LPDR\Tools;

        class CrudController extends Controller
        {
            public function listAction()
            {
                $userTable = new UserTable();
                $users = $userTable->findAll();

                $this->render(__CLASS__ . ":" . "list", array("users" => $users));
            }

            public function deleteAction()
            {
                $id = $this->getParam("id");

                $userTable = new UserTable();
                $userTable->deleteOne($id);

                header("Location: ../../list");
                return true;
            }

            public function addAction()
            {
                if (false !== Tools::getParam("add"))
                {
                    $user = new UserTable();
                    $user->setFirstname(Tools::getParam("firstname"));
                    $user->setLastname(Tools::getParam("lastname"));
                    $user->setLogin(Tools::getParam("login"));
                    $user->setEmail(Tools::getParam("email"));

                    $user->insert();

                    header("Location: list");
                    return true;
                }
                $this->render(__CLASS__ . ":" . "add");
            }
        }
    }