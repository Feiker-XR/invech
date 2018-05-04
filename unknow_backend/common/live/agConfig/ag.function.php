<?php
/**
 * 投注类型转换
 * @param unknown $playType
 * @return string|unknown
 */
function convertType($playType){
    switch ($playType){
        case "BAC":
        case 'BAC':
        case 'CBAC':
        case 'LINK':
        case 'LBAC':
        case 'SBAC':
        case 'TG02':
            return 'BAC';
        default:
            return $playType;
    }
}