<?php

namespace app\classes;

class Bind
{

    /**
    * @var array
    */
    private static $bind = [];

    /**
    * @param $name
    * @param $value
    */
    public static function set($name, $value)
    {
        if (!isset(static::$bind[$name])) {
            static::$bind[$name] = $value;
        }
    }

    /**
    * @param $name
    * @return object
    * @throws \Exception
    */
    public function get($name)
    {
        if (!isset(static::$bind[$name])) {
            throw new \Exception("Esse índice não existe dentro do bind: {$name}.");
        }

        return (array) static::$bind[$name];
    }
}
