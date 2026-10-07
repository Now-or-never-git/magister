<?php
class A
{
    public static function test()
    {
        echo 1;
    }

    public static function get()
    {
        // Раннє статичне зв'язування: викликається метод test() з класу A
        self::test();
    }
}

class B extends A
{
    public static function test()
    {
        echo 2;
    }
}

B::get();
?>