<?php
class db
{
    public $db;
    protected static $_instance;

    private function __construct()
    {
        echo "<h1>Connecting with database</h1>";

        // Перевіряємо, чи увімкнено розширення mysqli у PHP
        if (class_exists('mysqli')) {
            $this->db = @new mysqli('localhost', 'root', '');
            if ($this->db->connect_error) {
                echo "Connection error";
            } else {
                $this->db->query("SET NAMES 'UTF8'");
            }
        } else {
            echo "<p><i>(Імітація підключення: розширення mysqli вимкнено у налаштуваннях PHP)</i></p>";
        }
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __clone()
    {
    }
    public function __wakeup()
    {
    }

    public function get_data()
    {
        $row = [];
        if (isset($this->db) && class_exists('mysqli')) {
            $query = "SELECT * from menu";
            $result = $this->db->query($query);
            if ($result) {
                for ($i = 0; $i < $result->num_rows; $i++) {
                    $row[] = $result->fetch_assoc();
                }
            }
        }
        return $row;
    }
}

$obj1 = db::getInstance();
$obj2 = db::getInstance();
$obj3 = db::getInstance();

echo "Перевірка Singleton: ";
var_dump($obj1 === $obj2 && $obj2 === $obj3);
?>