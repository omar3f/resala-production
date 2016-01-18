<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 02/12/15
 * Time: 03:53 ص
 */
function randStrGen($len){
    $result = "";
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
        $randItem = array_rand($charArray);
        $result .= "".$charArray[$randItem];
    }
    return $result;
}