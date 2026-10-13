<?php
header("Content-Type: text/html; charset=utf-8");

// Визначаємо інтерфейс Figure з двома методами
interface Figure
{
    public function draw();
    public function erase();
}

class Triangle implements Figure
{
    public function draw()
    {
        echo "Малюємо <b>Трикутник</b>...<br>";
    }

    public function erase()
    {
        echo "Стираємо Трикутник...<br><hr>";
    }
}

class Line implements Figure
{
    public function draw()
    {
        echo "Малюємо <b>Лінію</b>...<br>";
    }

    public function erase()
    {
        echo "Стираємо Лінію...<br><hr>";
    }
}

echo "<h3>Демонстрація Завдання 6 (Інтерфейс фігур):</h3>";

$triangle = new Triangle();
$triangle->draw();
$triangle->erase();

$line = new Line();
$line->draw();
$line->erase();
?>