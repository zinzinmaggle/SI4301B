<?php

class PDOModel extends \PDO
{

    private static $INSTANCE = null;
    public $auto_encode = false;

    public function __construct()
    {

        parent::__construct('mysql:host=127.0.0.1;dbname=skincsgo;charset=utf8', "root", "root");
    }

    public static function GetInstance($auto_encode = false)
    {
        if (self::$INSTANCE == null) {
            self::$INSTANCE = new PDOModel();
        }
        self::$INSTANCE->auto_encode = $auto_encode;

        return self::$INSTANCE;
    }

    public function quote($string, $parameter_type = PDO::PARAM_STR)
    {
        if ($this->auto_encode) {
            $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        }

        return parent::quote($string, $parameter_type);
    }

}
