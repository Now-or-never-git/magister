<?php
header("Content-Type: text/html; charset=utf-8");

class InputDevice
{
    // Захищені властивості класу
    protected $model;
    protected $interfaceType;

    public function __construct($model, $interfaceType)
    {
        $this->model = $model;
        $this->interfaceType = $interfaceType;
        echo "<i>[Конструктор InputDevice]: Створено пристрій '{$this->model}'</i><br>";
    }

    public function printInfo()
    {
        echo "Пристрій: <b>{$this->model}</b> | Інтерфейс: <b>{$this->interfaceType}</b><br>";
    }

    public function __destruct()
    {
        echo "<i>[Деструктор InputDevice]: Об'єкт '{$this->model}' знищено.</i><br>";
    }
}

// Спадкування класу Scanner від базового класу InputDevice
class Scanner extends InputDevice
{
    private $scanSpeed;

    public function __construct($model, $interfaceType, $scanSpeed)
    {
        //Виклик конструктора базового класу 
        parent::__construct($model, $interfaceType);

        $this->scanSpeed = $scanSpeed;
        echo "<i>[Конструктор Scanner]: Встановлено швидкість {$this->scanSpeed} стор./хв</i><br>";
    }

    public function calculateScanTime($pages)
    {
        if ($this->scanSpeed <= 0) {
            return 0;
        }
        return round($pages / $this->scanSpeed, 2);
    }

    // Перевизначення методу базового класу:
    public function printInfo()
    {
        echo "Сканер: <b>{$this->model}</b> | Інтерфейс: <b>{$this->interfaceType}</b> | Швидкість: <b>{$this->scanSpeed} стор./хв</b><br>";
    }

    public function __destruct()
    {
        echo "<i>[Деструктор Scanner]: Сканер '{$this->model}' завершив роботу.</i><br>";

        // Виклик деструктора базового класу
        parent::__destruct();
    }
}

echo "<h3>1. Робота з базовим класом (Пристрій введення інформації):</h3>";
$keyboard = new InputDevice("Logitech G Pro", "USB");
$keyboard->printInfo();

echo "<h3>2. Робота з похідним класом (Сканер):</h3>";
$scanner = new Scanner("Canon CanoScan LiDE 400", "USB Type-C", 8);
$scanner->printInfo();

$pagesToScan = 45;
$timeMinutes = $scanner->calculateScanTime($pagesToScan);
echo "Час, необхідний для сканування <b>{$pagesToScan}</b> сторінок: <b>{$timeMinutes} хв.</b><br><br>";

echo "<h3>3. Робота деструкторів при завершенні скрипту:</h3>";
?>