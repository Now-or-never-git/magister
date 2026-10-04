<?php
class Coor
{
    public $name; // Змінено з private на public, щоб працювало пряме звернення з прикладу

    function Getname()
    {
        echo $this->name;
    }

    function Setname($text)
    {
        $this->name = $text;
    }
}

$works = array(); // creating a new array

$works[0] = new Coor(); // writing a "Coor" object in array
$works[0]->name = " Nick "; // set a name

$works[1] = new Coor();
$works[1]->name = " Nick 1";

$works[2] = new Coor();
$works[2]->name = " Nick 2";

for ($i = 0; $i < 3; $i++) {
    echo $works[$i]->name;
}
// circle with printing names of objects in array
?>