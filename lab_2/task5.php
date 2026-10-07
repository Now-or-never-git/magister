<?php
header("Content-Type: text/html; charset=utf-8");

class InputDevice
{
    protected $model;
    protected $interfaceType;

    // Статичне поле для підрахунку кількості створених об'єктів
    public static $deviceCount = 0;

    public function __construct($model, $interfaceType)
    {
        $this->model = $model;
        $this->interfaceType = $interfaceType;

        // Звернення до статичного поля всередині класу
        self::$deviceCount++;
    }

    // Статичний метод
    public static function showTotalDevices()
    {
        echo "Загальна кількість створених пристроїв (статичний метод): <b>" . self::$deviceCount . "</b><br>";
    }

    public function printInfo()
    {
        echo "Пристрій: <b>{$this->model}</b> | Інтерфейс: <b>{$this->interfaceType}</b><br>";
    }

    public function __destruct()
    {
        echo "<i>[Деструктор InputDevice]: '{$this->model}' знищено.</i><br>";
    }
}

class Scanner extends InputDevice
{
    private $scanSpeed;

    public function __construct($model, $interfaceType, $scanSpeed)
    {
        //Виклик батьківського конструктора
        parent::__construct($model, $interfaceType);
        $this->scanSpeed = $scanSpeed;
    }

    public function calculateScanTime($pages)
    {
        return ($this->scanSpeed > 0) ? round($pages / $this->scanSpeed, 2) : 0;
    }

    // Перевизначення методу базового класу
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

echo "<h3>Демонстрація роботи зі статичним полем та статичним методом:</h3>";

// Виклик статичного методу через ім'я класу
InputDevice::showTotalDevices();
echo "<br>";

$dev1 = new InputDevice("Миша Razer DeathAdder", "USB");
$dev1->printInfo();

$scan1 = new Scanner("Canon CanoScan LiDE 400", "USB Type-C", 8);
$scan1->printInfo();

$scan2 = new Scanner("Epson Perfection V39", "USB 2.0", 12);
$scan2->printInfo();

echo "<br>";
// Пряме звернення до статичного поля ззовні класу
echo "Звернення до статичного поля напряму: <b>" . InputDevice::$deviceCount . "</b><br>";
Scanner::showTotalDevices();
echo "<br>";
?>