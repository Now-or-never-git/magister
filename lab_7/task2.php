<?php
header("Content-Type: text/html; charset=utf-8");
// Клас, що представляє обробник платежів у ланцюжку відповідальності
abstract class PaymentHandler
{
    protected $nextHandler;

    public function setNext(PaymentHandler $next)
    {
        $this->nextHandler = $next;
        return $next;
    }

    abstract public function pay($amount);
}
// Клас для обробки платежів з основного рахунку
class MainAccount extends PaymentHandler
{
    private $balance;

    public function __construct($balance)
    {
        $this->balance = $balance;
    }

    public function pay($amount)
    {
        echo "<i>Запит на оплату {$amount} грн з основного рахунку...</i><br>";
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            echo "<b>Успіх:</b> Оплату здійснено з основного рахунку. Залишок: {$this->balance} грн.<br><br>";
        } else {
            echo "Недостатньо коштів на основному рахунку. Перехід до наступного способу оплати...<br>";
            if ($this->nextHandler) {
                $this->nextHandler->pay($amount);
            } else {
                echo "<b>Помилка:</b> Оплату відхилено внаслідок недостатньої кількості коштів на рахунку.<br><br>";
            }
        }
    }
}

// Клас для обробки платежів з кредитної картки
class CreditCard extends PaymentHandler
{
    private $creditLimit;

    public function __construct($creditLimit)
    {
        $this->creditLimit = $creditLimit;
    }
    // Метод для обробки платежів з кредитної картки
    public function pay($amount)
    {
        echo "<i>Запит на оплату {$amount} грн з кредитної картки...</i><br>";
        if ($this->creditLimit >= $amount) {
            $this->creditLimit -= $amount;
            echo "<b>Успіх:</b> Оплату здійснено з кредитної картки. Залишок ліміту: {$this->creditLimit} грн.<br><br>";
        } else {
            echo "Недостатньо ліміту на кредитній картці.<br>";
            if ($this->nextHandler) {
                $this->nextHandler->pay($amount);
            } else {
                echo "<b>Помилка:</b> Оплату відхилено внаслідок недостатньої кількості коштів на всіх рахунках.<br><br>";
            }
        }
    }
}

$mainAccount = new MainAccount(1000);
$creditCard = new CreditCard(5000);

// Формуємо ланцюжок де спочатку основний рахунок, потім кредитка
$mainAccount->setNext($creditCard);

echo "<h3>Спроба 1: Покупка на 800 грн</h3>";
$mainAccount->pay(800);

echo "<h3>Спроба 2: Покупка на 3000 грн</h3>";
$mainAccount->pay(3000);

echo "<h3>Спроба 3: Покупка на 10000 грн</h3>";
$mainAccount->pay(10000);
?>