<?php
header("Content-Type: text/html; charset=utf-8");
// Клас, що представляє обробник перепису населення у ланцюжку відповідальності
abstract class TerritoryCensusHandler
{
    protected $nextHandler;

    public function setNext(TerritoryCensusHandler $next)
    {
        $this->nextHandler = $next;
        return $next;
    }

    abstract public function processCensus($population, $language);
}
// Клас для обробки перепису на рівні місцевої адміністрації
class LocalAdministration extends TerritoryCensusHandler
{
    public function processCensus($population, $language)
    {
        if ($population <= 100000) {
            echo "<b>Місцева адміністрація</b> обробила дані перепису: {$population} осіб, мова: {$language}.<br>";
        } elseif ($this->nextHandler) {
            echo "Місцевій адміністрації не вистачає ресурсів. Передача на рівень області...<br>";
            $this->nextHandler->processCensus($population, $language);
        }
    }
}
// Клас для обробки перепису на рівні обласної адміністрації
class RegionalAdministration extends TerritoryCensusHandler
{
    public function processCensus($population, $language)
    {
        if ($population > 100000 && $population <= 1000000) {
            echo "<b>Обласна адміністрація</b> обробила дані перепису: {$population} осіб, мова: {$language}.<br>";
        } elseif ($this->nextHandler) {
            echo "Обласній адміністрації не вистачає ресурсів. Передача на рівень країни...<br>";
            $this->nextHandler->processCensus($population, $language);
        }
    }
}
// Клас для обробки перепису на рівні уряду країни
class CountryGovernment extends TerritoryCensusHandler
{
    public function processCensus($population, $language)
    {
        if ($population > 1000000) {
            echo "<b>Уряд країни</b> взяв під контроль обробку даних перепису: {$population} осіб, мова: {$language}.<br>";
        }
    }
}

// Обробка запитів на перепис населення
$local = new LocalAdministration();
$regional = new RegionalAdministration();
$country = new CountryGovernment();

// Побудова ланцюжка
$local->setNext($regional)->setNext($country);

echo "<h3>Запит 1: Перепис малого міста (50 000 осіб)</h3>";
$local->processCensus(50000, "Українська");

echo "<h3>Запит 2: Перепис великого міста (500 000 осіб)</h3>";
$local->processCensus(500000, "Українська");

echo "<h3>Запит 3: Всеукраїнський перепис (38 000 000 осіб)</h3>";
$local->processCensus(38000000, "Українська");
?>