<?php

namespace core\base;


final class Config
{
    private static $instance;

    public static function getInstance(): Config
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
    }

    private function __clone() {}

    private function __wakeup() {}
}
