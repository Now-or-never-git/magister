<?php
header("Content-Type: text/html; charset=utf-8");

class TextFileEditor
{
    private $filename;

    public function __construct($filename)
    {
        if (!file_exists($filename)) {
            exit("Файл не знайдено!");
        }
        $this->filename = $filename;
    }

    public function showContent()
    {
        return nl2br(file_get_contents($this->filename));
    }

    public function removeFirstAndLastLines()
    {
        $lines = file($this->filename, FILE_IGNORE_NEW_LINES);

        if (count($lines) >= 2) {
            array_shift($lines);
            array_pop($lines);
            file_put_contents($this->filename, implode(PHP_EOL, $lines));
        } else {
            file_put_contents($this->filename, "");
        }
    }
}

$editor = new TextFileEditor("text17.txt");

echo "<b>Вміст файлу ДО видалення:</b><br>";
echo $editor->showContent() . "<br><br>";

$editor->removeFirstAndLastLines();

echo "<b>Вміст файлу ПІСЛЯ видалення першого та останнього рядків:</b><br>";
echo $editor->showContent() . "<br>";
?>