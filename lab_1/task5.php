<?php
header("Content-Type: text/html; charset=utf-8");

class WorkWithFile
{
    public $buff;
    public $filename;

    function __construct($filename)
    {
        $uploaddir = './';
        $this->filename = $uploaddir . $filename;

        if (!file_exists($this->filename))
            exit("File does not exist");

        $fd = fopen($filename, "r");
        if (!$fd)
            exit("File open error");

        $this->buff = fread($fd, filesize($this->filename));
        fclose($fd);
    }

    function getContent()
    {
        return nl2br($this->buff);
    }

    function getsize()
    {
        return filesize($this->filename);
    }

    function getCount()
    {
        if (!empty($this->filename)) {
            $arr = file($this->filename);
            return count($arr);
        } else {
            return 0;
        }
    }
}

$first = new WorkWithFile("count.txt");
echo "<b>Вміст файлу:</b><br>{$first->getContent()}<br><br>";
echo "<b>Розмір файлу (байт):</b> {$first->getsize()}<br>";
echo "<b>Кількість рядків:</b> {$first->getCount()}<br>";
?>