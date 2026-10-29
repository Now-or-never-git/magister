<?php
class Coor
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

class CoorFactory
{
    public static function create($name)
    {
        return new Coor($name);
    }
}

$object = CoorFactory::create("Nick");
echo $object->getName();
?>