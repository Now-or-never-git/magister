<?php
// Клас прототипу для країн
class CountryPrototype
{
    public $area;
    public $population;
    public $language;

    public function __construct($area, $population, $language)
    {
        $this->area = $area;
        $this->population = $population;
        $this->language = $language;
    }
    // Метод клонування об'єкта
    public function __clone()
    {
    }

    public function getInfo()
    {
        return "Площа: {$this->area} | Населення: {$this->population} | Мова: {$this->language}<br>";
    }
}

$baseCountry = new CountryPrototype(603628, 38000000, "Українська");

$country1 = clone $baseCountry;
echo "Оригінал (Україна): " . $country1->getInfo();

$country2 = clone $baseCountry;
$country2->area = 312685;
$country2->population = 38000000;
$country2->language = "Польська";
echo "Клон зі змінами (Польща): " . $country2->getInfo();
?>