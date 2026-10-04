<?php
header("Content-Type: text/html; charset=utf-8");

echo "<h3>1. Конструктор та видалення об'єкта через unset():</h3>";

class Coor
{
    private $text;

    function __construct($text)
    {
        $this->text = $text;
    }

    function Getname()
    {
        echo "Name: " . $this->text . "<br>";
    }
}

$object = new Coor("Nick");
$object->Getname();

unset($object);
if (!isset($object)) {
    echo "<b>Object is deleted!</b><br>";
}

echo "<h3>2. Клас із деструктором та полями \$login і \$password (3 об'єкти):</h3>";

class CoorUsers
{
    private $name;
    private $login;
    private $password;

    function __construct($name, $login, $password)
    {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
    }

    function Getname()
    {
        echo "Name: <b>{$this->name}</b> | Login: <b>{$this->login}</b> | Password: <b>{$this->password}</b><br>";
    }

    function __destruct()
    {
        print "Destroying " . $this->name . "<br>";
    }
}

$user1 = new CoorUsers("Nick", "nick_login", "pass111");
$user2 = new CoorUsers("Alex", "alex_login", "pass222");
$user3 = new CoorUsers("Olga", "olga_login", "pass333");

$user1->Getname();
$user2->Getname();
$user3->Getname();
echo "<br>";
?>