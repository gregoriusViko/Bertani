<?php
class WeightConverter
{
    public static function convert($kilograms){
        if($kilograms>=1000){
            return ($kilograms/1000) . ' ton';
        }else if($kilograms>=1){
            return $kilograms . ' Kg';
        }
        return ($kilograms * 1000) . 'gram';
    }
}