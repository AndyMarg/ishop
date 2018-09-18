<?php

namespace core\base;

use core\base\Utils;

class UtilsTest extends \PHPUnit\Framework\TestCase {
    
    protected static $arr_1 = [];
    protected static $arr_2 = [];
    protected static $arr_union = [];

    public static function setUpBeforeClass() {
        self::$arr_1 = json_decode(file_get_contents(dirname(dirname(__DIR__)) . '/data/config_app.json'), true);
        self::$arr_2 = json_decode(file_get_contents(dirname(dirname(__DIR__)) . '/data/config_default.json'), true);
        self::$arr_union = json_decode(file_get_contents(dirname(dirname(__DIR__)) . '/data/config_test.json'), true);
    }

    public function testMergeArrays() {
        $result = Utils::mergeArrays(self::$arr_1, self::$arr_2);
        $this->assertEmpty($result);
        
    }

}
