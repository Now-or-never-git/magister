<?php
// Продукти
interface AbstractCar
{
    public function getDetails();
}
interface AbstractTruck
{
    public function getDetails();
}
interface AbstractBus
{
    public function getDetails();
}

class UaCar implements AbstractCar
{
    public function getDetails()
    {
        return "UA Легковий автомобіль (ЗАЗ)";
    }
}
class ForeignCar implements AbstractCar
{
    public function getDetails()
    {
        return "Foreign Легковий автомобіль (Volkswagen)";
    }
}

class UaTruck implements AbstractTruck
{
    public function getDetails()
    {
        return "UA Вантажівка (КрАЗ)";
    }
}
class ForeignTruck implements AbstractTruck
{
    public function getDetails()
    {
        return "Foreign Вантажівка (MAN)";
    }
}

class UaBus implements AbstractBus
{
    public function getDetails()
    {
        return "UA Автобус (Богдан)";
    }
}
class ForeignBus implements AbstractBus
{
    public function getDetails()
    {
        return "Foreign Автобус (Mercedes)";
    }
}

// Абстрактна фабрика
abstract class VehicleAbstractFactory
{
    abstract public function createCar(): AbstractCar;
    abstract public function createTruck(): AbstractTruck;
    abstract public function createBus(): AbstractBus;
}

class UaVehicleFactory extends VehicleAbstractFactory
{
    public function createCar(): AbstractCar
    {
        return new UaCar();
    }
    public function createTruck(): AbstractTruck
    {
        return new UaTruck();
    }
    public function createBus(): AbstractBus
    {
        return new UaBus();
    }
}

class ForeignVehicleFactory extends VehicleAbstractFactory
{
    public function createCar(): AbstractCar
    {
        return new ForeignCar();
    }
    public function createTruck(): AbstractTruck
    {
        return new ForeignTruck();
    }
    public function createBus(): AbstractBus
    {
        return new ForeignBus();
    }
}

// Парсер
$configFile = "factory=ua carNum=2 truckNum=1 busNum=1";
preg_match('/factory=(\w+)/', $configFile, $matchFactory);
preg_match('/carNum=(\d+)/', $configFile, $matchCar);
preg_match('/truckNum=(\d+)/', $configFile, $matchTruck);
preg_match('/busNum=(\d+)/', $configFile, $matchBus);

$factoryType = $matchFactory[1] ?? 'ua';
$carNum = $matchCar[1] ?? 0;
$truckNum = $matchTruck[1] ?? 0;
$busNum = $matchBus[1] ?? 0;

$factory = ($factoryType === 'foreign') ? new ForeignVehicleFactory() : new UaVehicleFactory();
$fleet = [];

for ($i = 0; $i < $carNum; $i++)
    $fleet[] = $factory->createCar();
for ($i = 0; $i < $truckNum; $i++)
    $fleet[] = $factory->createTruck();
for ($i = 0; $i < $busNum; $i++)
    $fleet[] = $factory->createBus();

echo "<b>Створено автопарк ($factoryType):</b><br>";
foreach ($fleet as $vehicle) {
    echo $vehicle->getDetails() . "<br>";
}
?>