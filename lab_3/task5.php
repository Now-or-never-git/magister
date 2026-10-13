<?php
header("Content-Type: text/html; charset=utf-8");

interface ILoger
{
    public function log($message);
}

class DbLoger implements ILoger
{

    // Реалізація методу з інтерфейсу ILoger
    public function log($message)
    {
        $date = date("Y-m-d H:i:s");

        $sql = "INSERT INTO logs (log_date, log_message) VALUES ('$date', '$message');";

        echo "<i>[Підключення до БД успішне]</i><br>";
        echo "Виконується SQL-запит: <b>" . $sql . "</b><br><br>";
    }
}

echo "<h3>Демонстрація Завдання 5 (DbLoger):</h3>";
$dbLogger = new DbLoger();
$dbLogger->log("Користувач увійшов у систему");
$dbLogger->log("Помилка підключення до API");
?>