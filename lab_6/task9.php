<?php
// Старий сервіс для отримання площі в акрах
class OldAreaService
{
    public function getAreaInAcres()
    {
        return 149158300;
    }
}
// Цільовий інтерфейс для отримання площі в квадратних кілометрах
interface IAreaTarget
{
    public function getAreaInSquareKm();
}
// Адаптер для перетворення площі з акрів у квадратні кілометри
class MetricAreaAdapter implements IAreaTarget
{
    private $oldService;

    public function __construct(OldAreaService $service)
    {
        $this->oldService = $service;
    }

    public function getAreaInSquareKm()
    {
        $acres = $this->oldService->getAreaInAcres();
        return round($acres * 0.00404686);
    }
}
// Клієнтський клас для аналізу густоти населення
class CountryAnalyzer
{
    public function showDensity($population, IAreaTarget $areaProvider)
    {
        $area = $areaProvider->getAreaInSquareKm();
        $density = round($population / $area, 2);
        echo "Площа країни: {$area} км²<br>";
        echo "Густота населення: {$density} осіб/км²<br>";
    }
}

$oldData = new OldAreaService();
$adapter = new MetricAreaAdapter($oldData);

$analyzer = new CountryAnalyzer();
$analyzer->showDensity(38000000, $adapter);
?>