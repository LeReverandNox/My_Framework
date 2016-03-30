<?php
    namespace LPDR
    {
        abstract class Model
        {
            private static $hostname = "127.0.0.1";
            private static $port = "3306" ;
            private static $socket = null;
            private static $username = "laidet_r";
            private static $password = "94Wq6E3Q8DzbSWR401NO";
            private static $dbname = "laidet_r_my_framework";

            protected static $pdo;

            public static function getHostname()
            {
                return self::$host;
            }
            public static function setHostname($hostname)
            {
                self::$hostname = $hostname;
            }

            public static function getPort()
            {
                return self::$port;
            }
            public static function setPort($port)
            {
                self::$port = $port;
            }

            public static function getSocket()
            {
                return self::$socket;
            }
            public static function setSocket($socket)
            {
                self::$socket = $socket;
            }

            public static function getUsername()
            {
                return self::$username;
            }
            public static function setUsername($username)
            {
                self::$username = $username;
            }

            public static function getPassword()
            {
                return self::$password;
            }
            public static function setPassword($password)
            {
                self::$password = $password;
            }



            public static function getDbname()
            {
                return self::$dbname;
            }
            public static function setDbname($dbname)
            {
                self::$dbname = $dbname;
            }


            public function __construct()
            {
                if (null === self::$pdo)
                {
                    try {
                        if (null !== self::$socket)
                        {
                            self::$pdo = new \PDO("mysql:dbname=" . self::$dbname . ";unix_socket=" . self::$socket, self::$username, self::$password);
                        }
                        else
                        {
                            self::$pdo = new \PDO("mysql:dbname=" . self::$dbname . ";host=" . self::$hostname . ";port=" . self::$port, self::$username, self::$password);
                        }
                    } catch (PDOException $e) {
                        echo "Failed to connect to the database : " . $e;
                    }
                }
            }

            public function findOne($placeholders, $values)
            {
                $sql = "SELECT * FROM " . $this->table . " WHERE " . $placeholders;
                $rqt = self::$pdo->prepare($sql);
                $rqt->execute($values);
                $res = $rqt->fetchAll(\PDO::FETCH_ASSOC);
                $rqt->closeCursor();

                return $res[0];
            }
        }
    }