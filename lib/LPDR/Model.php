<?php
    namespace LPDR
    {
        abstract class Model
        {
            private static $host;
            private static $port;
            private static $socket;
            private static $username;
            private static $password;

            private static $pdo;

            public function __construct()
            {
                if (null === self::$pdo) {
                    # code...
                }
            }
        }
    }