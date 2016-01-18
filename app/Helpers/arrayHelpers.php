<?php
function array_same_key_val($arr) {
    $new_arr = [];
    foreach($arr as $key => $val) {
        $new_arr[$val] = $val;
    }
    return $new_arr;
}
