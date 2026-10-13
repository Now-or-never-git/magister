<?php
header("Content-Type: text/html; charset=utf-8");

// Інтерфейс 1
interface IPowerable
{
    public function turnOn();
    public function turnOff();
}

// Інтерфейс 2
interface IScannable
{
    public function scanDocument($pages);
}

// Клас Scanner реалізує одразу два інтерфейси
class Scanner implements IPowerable, IScannable
{
    private $model;
    private $isOn = false;

    public function __construct($model)
    {
        $this->model = $model;
    }

    // Реалізація методів з IPowerable
    public function turnOn()
    {
        $this->isOn = true;
        echo "Сканер {$this->model} <b>УВІМКНЕНО</b>.<br>";
    }

    public function turnOff()
    {
        $this->isOn = false;
        echo "Сканер {$this->model} <b>ВИМКНЕНО</b>.<br>";
    }

    // Реалізація методу з IScannable
    public function scanDocument($pages)
    {
        if (!$this->isOn) {
            echo "<i>Помилка: Неможливо сканувати, сканер вимкнено!</i><br>";
            return;
        }
        echo "Сканер {$this->model} успішно відсканував <b>{$pages}</b> сторінок.<br>";
    }
}

echo "<h3>Демонстрація Завдання 8 (Варіант 17 - Сканер):</h3>";
$myScanner = new Scanner("Canon CanoScan LiDE");

// Спроба сканувати вимкненим сканером
$myScanner->scanDocument(5);

$myScanner->turnOn();
$myScanner->scanDocument(15);
$myScanner->turnOff();
?>