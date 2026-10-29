<?php
abstract class Vehicle
{
    protected $country;
    protected $make;
    protected $year;

    public function __construct($country, $make, $year)
    {
        $this->country = $country;
        $this->make = $make;
        $this->year = $year;
    }

    abstract public function getInfo();
}

class Car extends Vehicle
{
    private $engine;
    private $power;
    private $color;

    public function __construct($country, $make, $year, $engine, $power, $color)
    {
        parent::__construct($country, $make, $year);
        $this->engine = $engine;
        $this->power = $power;
        $this->color = $color;
    }

    public function getInfo()
    {
        return "Автомобіль: $this->make ($this->country), $this->year р., Колір: $this->color";
    }
}

class Bike extends Vehicle
{
    private $weight;
    private $type;
    private $wheelDiameter;

    public function __construct($country, $make, $year, $weight, $type, $wheelDiameter)
    {
        parent::__construct($country, $make, $year);
        $this->weight = $weight;
        $this->type = $type;
        $this->wheelDiameter = $wheelDiameter;
    }

    public function getInfo()
    {
        return "Велосипед: $this->make ($this->type), Вага: $this->weight кг";
    }
}

class Motorcycle extends Vehicle
{
    private $engine;
    private $color;
    private $type;

    public function __construct($country, $make, $year, $engine, $color, $type)
    {
        parent::__construct($country, $make, $year);
        $this->engine = $engine;
        $this->color = $color;
        $this->type = $type;
    }

    public function getInfo()
    {
        return "Мотоцикл: $this->make ($this->type), Двигун: $this->engine";
    }
}

class VehicleFactory
{
    public static function create($type, ...$params)
    {
        switch (strtolower($type)) {
            case 'car':
                return new Car(...$params);
            case 'bike':
                return new Bike(...$params);
            case 'motorcycle':
                return new Motorcycle(...$params);
            default:
                throw new Exception("Фабрика не може створити даний транспортний засіб: $type");
        }
    }
}

try {
    $car = VehicleFactory::create('car', 'Німеччина', 'BMW', 2022, 'V8', 400, 'Чорний');
    echo $car->getInfo() . "<br>";

    $bike = VehicleFactory::create('bike', 'Тайвань', 'Giant', 2023, 12, 'Гірський', 29);
    echo $bike->getInfo() . "<br>";

    // Викличе помилку
    $plane = VehicleFactory::create('plane', 'США', 'Boeing', 2020);
} catch (Exception $e) {
    echo "<b>Помилка:</b> " . $e->getMessage();
}
?>