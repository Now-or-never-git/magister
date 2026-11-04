<?php
// Клас для відправки SMS-повідомлень
class AdvancedSmsService
{
    protected $_recipient;
    protected $_message;
    protected $_time;

    public function setRecipient($recipient)
    {
        $this->_recipient = $recipient;
    }
    public function setMessage($text)
    {
        $this->_message = $text;
    }
    public function setTime($time)
    {
        $this->_time = $time;
    }

    public function sendText()
    {
        echo "Відправлено SMS на номер " . $this->_recipient . " о " . $this->_time . ". Текст: " . $this->_message . "<br>";
    }
}
// Інтерфейс для адаптера
interface AdvancedNotificationInterface
{
    public function setData($data);
    public function sendNotification();
}
// Адаптер для AdvancedSmsService
class AdvancedSmsAdapter implements AdvancedNotificationInterface
{
    protected $_data;

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function sendNotification()
    {
        $smsClient = new AdvancedSmsService();
        $smsClient->setRecipient($this->_data['recipient']);
        $smsClient->setMessage($this->_data['message']);

        $time = isset($this->_data['time']) ? $this->_data['time'] : date("H:i");
        $smsClient->setTime($time);

        $smsClient->sendText();
    }
}

$notification = new AdvancedSmsAdapter();
$notification->setData(array(
    "message" => "Ваше замовлення прийнято",
    "recipient" => "+380501112233",
    "time" => "14:30"
));
$notification->sendNotification();
?>