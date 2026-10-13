<?php
interface ILoger
{
    public function log($message);
}

class FileLoger implements ILoger
{
    private $file;
    private $logFile;

    public function __construct($filename, $mode = 'a')
    {
        $this->logFile = $filename;
        $this->file = fopen($filename, $mode) or die('Could not open the log file');
    }

    public function log($message)
    {
        $message = date("F j, Y, g:i a") . ': ' . $message . "\n";
        fwrite($this->file, $message);
        echo $message . "<br>";
    }

    public function __destruct()
    {
        if ($this->file) {
            fclose($this->file);
        }
    }
}

$FLog = new FileLoger('./log.txt', 'w');
$FLog->log('log message');
$FLog->log('another log message');
?>