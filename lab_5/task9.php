<?php
interface Factory
{
    public function getProduct();
}

interface Product
{
    public function getName();
}

class FirstFactory implements Factory
{
    public function getProduct()
    {
        return new FirstProduct();
    }
}

class SecondFactory implements Factory
{
    public function getProduct()
    {
        return new SecondProduct();
    }
}

class FirstProduct implements Product
{
    public function getName()
    {
        return 'The first product';
    }
}

class SecondProduct implements Product
{
    public function getName()
    {
        return 'Second product';
    }
}

$factory1 = new FirstFactory();
$firstProduct = $factory1->getProduct();

$factory2 = new SecondFactory();
$secondProduct = $factory2->getProduct();

print_r($firstProduct->getName());
echo "<br>";
print_r($secondProduct->getName());
?>