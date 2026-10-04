<?php
header("Content-Type: text/html; charset=utf-8");

class Country
{
    public $area;
    public $population;
    public $language;
    private $capital;

    public function set($area, $population, $language, $capital = "Не вказано")
    {
        $this->area = $area;
        $this->population = $population;
        $this->language = $language;
        $this->capital = $capital;
    }

    public function get()
    {
        return "Площа: {$this->area} км², Населення: {$this->population}, Мова: {$this->language}, Столиця: {$this->capital}";
    }

    private function getDensity()
    {
        return ($this->area > 0) ? round($this->population / $this->area, 2) : 0;
    }

    public function show()
    {
        echo "Площа: <b>{$this->area}</b> км² | Населення: <b>{$this->population}</b> | Мова: <b>{$this->language}</b> | Столиця: <b>{$this->capital}</b> ";
        echo "<i>(Густота населення: " . $this->getDensity() . " осіб/км²)</i><br>";
    }

    public function search($searchLanguage)
    {
        return $this->language === $searchLanguage;
    }

    public function setCapital($capital)
    {
        $this->capital = $capital;
    }

    public function getCapital()
    {
        return $this->capital;
    }

    public function show_objects($objectsArray)
    {
        foreach ($objectsArray as $index => $obj) {
            echo ($index + 1) . ") ";
            $obj->show();
        }
    }
}

echo "<h3>1. Створення 3 об'єктів класу Country та виведення через show():</h3>";
$c1 = new Country();
$c1->set(603628, 38000000, "Українська", "Київ");

$c2 = new Country();
$c2->set(357022, 84000000, "Німецька", "Берлін");

$c3 = new Country();
$c3->set(377975, 125000000, "Японська", "Токіо");

$c1->show();
$c2->show();
$c3->show();

echo "<h3>2. Перевірка методу get() та пошуку search():</h3>";
echo "Метод get() для 1-го об'єкта: " . $c1->get() . "<br><br>";

$targetLang = "Японська";
echo "Пошук країни за мовою '<b>{$targetLang}</b>':<br>";
foreach ([$c1, $c2, $c3] as $country) {
    if ($country->search($targetLang)) {
        echo "Знайдено: ";
        $country->show();
    }
}

echo "<h3>3. Демонстрація інкапсуляції (робота з private полем \$capital):</h3>";
$c1->setCapital("Київ (столиця України)");
echo "Значення приватного поля \$capital через getCapital(): <b>" . $c1->getCapital() . "</b><br>";

echo "<h3>4. Масив із 5 об'єктів та виведення через метод show_objects():</h3>";
$c4 = new Country();
$c4->set(551695, 68000000, "Французька", "Париж");

$c5 = new Country();
$c5->set(301340, 59000000, "Італійська", "Рим");

$countriesArray = [$c1, $c2, $c3, $c4, $c5];
$c1->show_objects($countriesArray);
?>