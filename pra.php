<?php
class Fruit
{
    public $name;
    protected $color;
    private $weight;
}
$mango = new Fruit();
$mango->name = 'Mango';

echo $mango->name;

class pi
{
    public static $value = 3.14159;
}

echo pi::$value;
