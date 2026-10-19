<?php
header("Content-Type: text/html; charset=utf-8");

trait my_first_trait
{
    public function traitFunction()
    {
        echo "Hello world<br>";
    }

    // Нова функція для привітання залежно від часу доби
    public function greetingByTime()
    {
        $hour = date('H');

        if ($hour >= 5 && $hour < 12) {
            echo "Good morning";
        } elseif ($hour >= 12 && $hour < 18) {
            echo "Good day";
        } elseif ($hour >= 18 && $hour < 22) {
            echo "Good evening";
        } else {
            echo "Good night";
        }
    }
}

class helloWorld
{
    use my_first_trait;
}

$objTest = new helloWorld();
$objTest->traitFunction();
$objTest->greetingByTime();
?>