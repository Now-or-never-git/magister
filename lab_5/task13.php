<?php
trait SharedDisplayMethods
{
    public function displayBaseInfo($area, $population)
    {
        return "Площа: {$area} км², Населення: {$population} осіб";
    }
}

interface AbstractTerritory
{
    public function getInfo();
}

class EuropeanCountry implements AbstractTerritory
{
    use SharedDisplayMethods;
    public function getInfo()
    {
        return "Європейська країна | " . $this->displayBaseInfo(603628, 38000000);
    }
}

class AsianCountry implements AbstractTerritory
{
    use SharedDisplayMethods;
    public function getInfo()
    {
        return "Азіатська країна | " . $this->displayBaseInfo(377975, 125000000);
    }
}

abstract class ContinentFactory
{
    abstract public function createCountry(): AbstractTerritory;
}

class EuropeFactory extends ContinentFactory
{
    public function createCountry(): AbstractTerritory
    {
        return new EuropeanCountry();
    }
}

class AsiaFactory extends ContinentFactory
{
    public function createCountry(): AbstractTerritory
    {
        return new AsianCountry();
    }
}

$euFactory = new EuropeFactory();
echo $euFactory->createCountry()->getInfo() . "<br>";

$asiaFactory = new AsiaFactory();
echo $asiaFactory->createCountry()->getInfo();
?>