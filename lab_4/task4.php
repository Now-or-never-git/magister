<?php
header("Content-Type: text/html; charset=utf-8");

// Трейт 1
trait EconomyInfo
{
    public $gdp;

    public function setEconomy($gdp)
    {
        $this->gdp = $gdp;
    }

    public function getEconomyInfo()
    {
        return "ВВП становить: <b>{$this->gdp} млрд $</b>";
    }
}

// Трейт 2
trait GeographyInfo
{
    public $climate;

    public function setClimate($climate)
    {
        $this->climate = $climate;
    }

    public function getGeographyInfo()
    {
        return "Клімат: <b>{$this->climate}</b>";
    }
}

abstract class Territory
{
    public $area;
    public $population;

    public function __construct($area, $population)
    {
        $this->area = $area;
        $this->population = $population;
    }
}

class Country extends Territory
{
    // Підключення двох трейтів одночасно
    use EconomyInfo, GeographyInfo;

    public $language;

    public function __construct($area, $population, $language)
    {
        parent::__construct($area, $population);
        $this->language = $language;
    }

    public function showFullInfo()
    {
        echo "<b>Країна</b> | Площа: {$this->area} км² | Мешканців: {$this->population} | Мова: {$this->language}<br>";

        // Виклик методів із підключених трейтів
        echo $this->getEconomyInfo() . "<br>";
        echo $this->getGeographyInfo() . "<br>";
    }
}

echo "<h3>Демонстрація Завдання 4 (Варіант 17):</h3>";

$ukraine = new Country(603628, 38000000, "Українська");
$ukraine->setEconomy(200);
$ukraine->setClimate("Помірно-континентальний");

$ukraine->showFullInfo();
?>