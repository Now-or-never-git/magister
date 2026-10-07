<?php
class A
{
    public static function test()
    {
        echo 1;
    }

    public static function get()
    {
        //викликається метод test() з класу, який викликав метод get()
        static::test();
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