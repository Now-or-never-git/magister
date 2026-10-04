<?php
header("Content-Type: text/html; charset=utf-8");

class CountryCSV
{
    private $_csv_file = null;

    public function __construct($csv_file)
    {
        if (file_exists($csv_file)) {
            $this->_csv_file = $csv_file;
        } else {
            throw new Exception("Файл не знайдено!");
        }
    }

    public function setCSV(array $csv)
    {
        $handle = fopen($this->_csv_file, "a");
        foreach ($csv as $value) {
            fputcsv($handle, explode(";", $value), ";", '"', "\\");
        }
        fclose($handle);
    }

    public function getCSV()
    {
        $handle = fopen($this->_csv_file, "r");
        $array_line_full = array();
        while (($line = fgetcsv($handle, 0, ";", '"', "\\")) !== FALSE) {
            $array_line_full[] = $line;
        }
        fclose($handle);
        return $array_line_full;
    }

    public function showCSV()
    {
        $records = $this->getCSV();
        foreach ($records as $value) {
            if (count($value) >= 3) {
                echo "Площа: <b>" . $value[0] . "</b> км² | ";
                echo "Кількість мешканців: <b>" . $value[1] . "</b> | ";
                echo "Мова: <b>" . $value[2] . "</b><br/>";
                echo "--------------------------------------------------------<br/>";
            }
        }
    }
}

try {
    $countryCsv = new CountryCSV("countries.csv");

    echo "<b>Дані з файлу countries.csv до додавання:</b><br/><br/>";
    $countryCsv->showCSV();

    $newCountry = array("551695;68000000;Французька");
    $countryCsv->setCSV($newCountry);

    echo "<br/><b>Дані після додавання нового запису:</b><br/><br/>";
    $countryCsv->showCSV();

} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage();
}
?>