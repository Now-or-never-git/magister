<?php
abstract class AbstractHandler
{
    protected $_next;

    abstract public function sendRequest($message);

    public function setNext($next)
    {
        $this->_next = $next;
    }

    public function getNext()
    {
        return $this->_next;
    }
}

class ConcreteHandlerA extends AbstractHandler
{
    public function sendRequest($message)
    {
        if ($message == 1) {
            echo __CLASS__ . " process this message";
        } else {
            if ($this->getNext()) {
                $this->getNext()->sendRequest($message);
            }
        }
    }
}

class ConcreteHandlerB extends AbstractHandler
{
    public function sendRequest($message)
    {
        if ($message == 2) {
            echo __CLASS__ . " process this message";
        } else {
            if ($this->getNext()) {
                $this->getNext()->sendRequest($message);
            }
        }
    }
}

$handler = new ConcreteHandlerA();
$handler->setNext(new ConcreteHandlerB());
$handler->sendRequest(1);
?>