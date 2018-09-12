<?php

namespace core\base;

class Application {

    private $config;

    public function __construct(string $config_file) {
        $this->config = Config::getInstance();
        echo $config_file;
        var_dump($this->config);
    }

    

} 