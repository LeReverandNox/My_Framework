<?php
    namespace app\models
    {
        use LPDR\Model;

        class UserTable extends Model
        {
            protected $table = "user";
            private $firstname;
            private $lastname;
            private $login;
            private $email;

            public function getFirstname()
            {
                return $this->firstname;
            }
            public function setFirstname($firstname)
            {
                $this->firstname = $firstname;
            }

            public function getLastname()
            {
                return $this->lastname;
            }
            public function setLastname($lastname)
            {
                $this->lastname = $lastname;
            }

            public function getLogin()
            {
                return $this->login;
            }
            public function setLogin($login)
            {
                $this->login = $login;
            }

            public function getEmail()
            {
                return $this->email;
            }
            public function setEmail($email)
            {
                $this->email = $email;
            }

            public function insert()
            {
                $sql = "INSERT INTO " . $this->table . "(firstname, lastname, login, email) VALUES(?, ?, ?, ?)";
                $rqt = self::$pdo->prepare($sql);
                $rqt->execute(array($this->firstname, $this->lastname, $this->login, $this->email));

                return true;
            }

        }
    }