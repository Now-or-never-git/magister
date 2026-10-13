<?php
header("Content-Type: text/html; charset=utf-8");

// Абстрактний батьківський клас
abstract class Territory
{
    public $area;
    public $population;

    public function __construct($area, $population)
    {
        $this->area = $area;
        $this->population = $population;
    }

    // Абстрактний метод
    abstract public function getDensity();
}

class Country extends Territory
{
    public $language;

    public function __construct($area, $population, $language)
    {
        parent::__construct($area, $population);
        $this->language = $language;
    }

    // Реалізація абстрактного методу
    public function getDensity()
    {
        return ($this->area > 0) ? round($this->population / $this->area, 2) : 0;
    }

    public function showInfo()
    {
        echo "<b>Країна</b> | Площа: {$this->area} | Мешканців: {$this->population} | Мова: {$this->language} | Густота: " . $this->getDensity() . "<br>";
    }
}

class City extends Territory
{
    public $mayor;

    public function __construct($area, $population, $mayor)
    {
        parent::__construct($area, $population);
        $this->mayor = $mayor;
    }

    public function getDensity()
    {
        return ($this->area > 0) ? round($this->population / $this->area, 2) : 0;
    }

    public function showInfo()
    {
        echo "<b>Місто</b> | Площа: {$this->area} | Мешканців: {$this->population} | Мер: {$this->mayor} | Густота: " . $this->getDensity() . "<br>";
    }
}

echo "<h3>Демонстрація Завдання 3 (Варіант 17 - Території):</h3>";
$ukraine = new Country(603628, 38000000, "Українська");
$ukraine->showInfo();

$sumy = new City(95.3, 259000, "О. Лисенко");
$sumy->showInfo();
?>