<?php
namespace App\Helpers;
class WeightConverter
{
    public static function convert($kilograms){
        if($kilograms>=1000){
            return number_format(($kilograms/1000), 2) . ' ton';
        }else if($kilograms>=1){
            return number_format($kilograms, 2) . ' Kg';
        }
        return number_format(($kilograms * 1000), 2) . ' gram';
    }
}