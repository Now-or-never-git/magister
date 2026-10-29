<?php
interface TerritoryFactory
{
    public function createTerritory($area, $population, $language);
}

interface TerritoryProduct
{
    public function getInfo();
}

class CountryFactory implements TerritoryFactory
{
    public function createTerritory($area, $population, $language)
    {
        return new CountryProduct($area, $population, $language);
    }
}

class CountryProduct implements TerritoryProduct
{
    private $area;
    private $population;
    private $language;

    public function __construct($area, $population, $language)
    {
        $this->area = $area;
        $this->population = $population;
        $this->language = $language;
    }

    public function getInfo()
    {
        return "Країна: Площа - {$this->area}, Мешканців - {$this->population}, Мова - {$this->language}";
    }
}

$factory = new CountryFactory();
$ukraine = $factory->createTerritory(603628, 38000000, 'Українська');
echo $ukraine->getInfo();
?>