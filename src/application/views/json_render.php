<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function array2JSON(&$inArray){
        if( is_array($inArray) ){
            foreach($inArray as &$value){
                if( is_array($value) ){
                    array2JSON($value);
                }
                else{
                    if(is_object($value) && method_exists($value,'getAsArray')){
                        $value = $value->getAsArray();
                    }
                }
            }
        }
    }
    
    header("Content-Type: application/json; charset=utf-8");
    
    if( is_array($jsonData) ){
        array2JSON($jsonData);
    }
    else{
        if(is_object($jsonData) && method_exists($jsonData,'getAsArray')){
            $jsonData = $jsonData->getAsArray();
        }
    }
    
    $jsonData = json_encode( $jsonData );
    echo $jsonData;
?>
