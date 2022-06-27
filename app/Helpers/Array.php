<?php

if (! function_exists('ArrToStr')) {
    function ArrToStr($arr) {
        return implode(';', array_map(fn($k, $v) => "$k=$v", array_keys($arr), $arr));
    }
}
