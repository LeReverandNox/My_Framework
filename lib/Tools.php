<?php
    class Tools
    {
        public static function getParam($param)
        {
            if (true === isset($_GET[$param]))
            {
                return $_GET[$param];
            }
            if (true === isset($_POST[$param]))
            {
                return $_POST[$param];
            }
            return false;
        }
    }