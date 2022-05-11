<?php

use Illuminate\Support\Str;



if (! function_exists('uuid')) {
    function uuid(){
        return Str::uuid()->toString();
    }
}

if (! function_exists('is_paid')) {
    function is_paid(int $price){
        return !is_null($price) && $price != 0;
    }
}
