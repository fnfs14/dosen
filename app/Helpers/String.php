<?php

if (! function_exists('StrToArray')) {
    function StrToArray($str) {
        $arr = explode(";",$str);
        $res = [];
        if(count($arr)<2){
            return $str;
        }
        foreach($arr as $k => $v){
            $value = explode("=",$v);
            $res[$value[0]] = $value[1];
        }
        return $res;
    }
}
