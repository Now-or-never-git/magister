<?php
class someClass
{
    protected static $_instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }
}

$obj1 = someClass::getInstance();
$obj2 = someClass::getInstance();

var_dump($obj1 === $obj2);

// $obj3 = new someClass(); 
?>