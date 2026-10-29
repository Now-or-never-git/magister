<?php
trait SingletonTrait
{
    protected static $_instance;

    private function __construct()
    {
    }
    private function __clone()
    {
    }
    public function __wakeup()
    {
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}

class MyClass
{
    use SingletonTrait;
}

$instance1 = MyClass::getInstance();
$instance2 = MyClass::getInstance();

var_dump($instance1 === $instance2);
?>