<?php
abstract class Figure
{
    protected $x;
    protected $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function showCenter()
    {
        echo "Center coordinates: ($this->x, $this->y)<br>";
    }

    abstract public function area();
}

class Circle extends Figure
{
    private $radius;

    public function __construct($x, $y, $radius)
    {
        parent::__construct($x, $y);
        $this->radius = $radius;
    }

    public function area()
    {
        return 3.14 * $this->radius * $this->radius;
    }
}

class Rectangle extends Figure
{
    private $width;
    private $height;

    public function __construct($x, $y, $width, $height)
    {
        parent::__construct($x, $y);
        $this->width = $width;
        $this->height = $height;
    }

    public function area()
    {
        return $this->width * $this->height;
    }
}

$circle = new Circle(0, 0, 5);
$circle->showCenter();
echo "Circle area: " . $circle->area() . "<br><br>";

$rectangle = new Rectangle(2, 2, 4, 6);
$rectangle->showCenter();
echo "Rectangle area: " . $rectangle->area() . "<br>";
?>