<?php
// Базовий абстрактний клас прототипу
abstract class VehiclePrototype
{
    public $make;
    public $country;
    abstract public function __clone();
}
// Конкретні типи транспортів
class CarPrototype extends VehiclePrototype
{
    public $type = "Легковий автомобіль";
    public function __clone()
    {
    }
}

class TruckPrototype extends VehiclePrototype
{
    public $type = "Вантажівка";
    public function __clone()
    {
    }
}

class BusPrototype extends VehiclePrototype
{
    public $type = "Автобус";
    public function __clone()
    {
    }
}
// Фабрика, виконується через клонування прототипів
class FleetPrototypeFactory
{
    private $carPrototype;
    private $truckPrototype;
    private $busPrototype;

    public function __construct(VehiclePrototype $car, VehiclePrototype $truck, VehiclePrototype $bus)
    {
        $this->carPrototype = $car;
        $this->truckPrototype = $truck;
        $this->busPrototype = $bus;
    }

    public function getCar()
    {
        return clone $this->carPrototype;
    }
    public function getTruck()
    {
        return clone $this->truckPrototype;
    }
    public function getBus()
    {
        return clone $this->busPrototype;
    }
}

$factory = new FleetPrototypeFactory(new CarPrototype(), new TruckPrototype(), new BusPrototype());

$car1 = $factory->getCar();
$car1->make = "ЗАЗ";
$car1->country = "Україна";

$truck1 = $factory->getTruck();
$truck1->make = "КрАЗ";
$truck1->country = "Україна";

echo "Створено: {$car1->type} {$car1->make} ({$car1->country})<br>";
echo "Створено: {$truck1->type} {$truck1->make} ({$truck1->country})<br>";
?>