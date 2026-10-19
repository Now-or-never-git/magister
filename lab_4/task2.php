<?php
header("Content-Type: text/html; charset=utf-8");

interface ILoger
{
    public function log($message);
}

// Трейт 1: Форматування дати та часу
trait TimeFormatter
{
    public function getCurrentTimeFormatted()
    {
        return date("F j, Y, g:i a");
    }
}

// Трейт 2: Запис до файлу
trait FileAppender
{
    public function appendToFile($filename, $content)
    {
        $file = fopen($filename, 'a');
        if ($file) {
            fwrite($file, $content . "\n");
            fclose($file);
        }
    }
}

class FileLoger implements ILoger
{
    // Множинне використання трейтів
    use TimeFormatter, FileAppender;

    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function log($message)
    {
        $time = $this->getCurrentTimeFormatted();
        $fullMessage = $time . ": " . $message;
        $this->appendToFile($this->filename, $fullMessage);
    }
}

// Обробка форми
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["log_message"])) {
    $logger = new FileLoger("log.txt");
    $logger->log($_POST["log_message"]);
    $status = "Повідомлення успішно збережено у log.txt!";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Форма Логера</title>
</head>

<body>
    <h3>Завдання 2: Додавання повідомлення у лог</h3>

    <form method="POST">
        <label>Введіть повідомлення:</label>
        <input type="text" name="log_message" required>
        <button type="submit">Зберегти</button>
    </form>

    <?php
    if (isset($status)) {
        echo "<p style='color: green;'><b>$status</b></p>";
    }
    ?>
</body>

</html>