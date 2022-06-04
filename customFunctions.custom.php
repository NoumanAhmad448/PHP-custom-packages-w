<?php

/** dd dependent functions  */
function not_function_exist($funName){
    return !function_exists($funName);
}

if(not_function_exist("parseBool2Str")){
    function parseBool2Str($bool){
        if($bool === false) return 'false';
        return 'true';
    }
}


if(not_function_exist('is_not_array')){
    function is_not_array($array){
        return !(is_array($array));
    }
}
/***
 * 
 * @description PHP display bool value differently in order to display them 
 * as is it, let's convert them to string.
 * i.e. true to 'true', false to 'false' * 
 *
***/

if(not_function_exist("parseBoolInArray2Str")){
    function parseBoolInArray2Str($array){
        if(is_not_array($array)){
            throw new Exception("given input is not a array");
        }
        $array = array_map(function($array){
            return is_array($array) ? array_map(function($val){
                return is_bool($val) ? parseBool2Str($val) : $val;
            }, $array) :
            (is_bool($array) ? parseBool2Str($array) : $array);
        },$array);
        return $array;
    }
}
/** dd dependent functions  */

/************
 * 
 * show output on screen just like echo but with colors schemes and 
 * deciding dynamically what type of input is given and what to use 
 * to show the output
 * 
 * 
 * @param Mixed
 * @return void
 * @author Nouman Ahmad
 * 
 * @dependency a number of functions defined above are required to use 
 * this function
 */

if (not_function_exist("dd")) {
    function dd(
        $ob,
        $exitOnPrint = false,
        $exactIndex = "",
        $maxIndex = 0,
        $showDataTypes = false,
        $bgColor = "#2b2a27",
        $color = "#fff",
        $fontSize = "14px"
    ) {
        echo "<div style='max-width: 100%'><pre style='background-color: " . $bgColor . " !important;color: " . $color . " !important;max-width: 100%; 
                padding: 6px; font-size: " . $fontSize . "; margin-top: 4px; margin-bottom: 4px; overflow-wrap: break-all;text-align: justify
                '>";
        if (is_array($ob) && !empty($maxIndex)) {
            $final_index = count($ob) < $maxIndex ? count($ob) : $maxIndex;
            for ($i = 0; $i < $final_index; $i++) {
                if ($showDataTypes) {
                    var_dump($ob[$i]);
                    echo "<br/>";
                } else {
                    if(is_bool($ob[$i])) $ob[$i] = parseBool2Str($ob[$i]);
                    print_r($ob[$i]);
                    echo "<br/>";
                }
            }
        } else if (is_array($ob) && $exactIndex != "") {
            if ($showDataTypes) {
                var_dump($ob[$exactIndex] ? $ob[$exactIndex] : "index out of range");;
            } else {
                print_r($ob[$exactIndex] ? $ob[$exactIndex] : "index out of range");
            }
        } else {
            if ($showDataTypes) {
                var_dump($ob);
            } else {
                $ob = is_array($ob) ? parseBoolInArray2Str($ob) : (is_bool($ob) ? parseBool2Str($ob) : $ob) ;               
                print_r($ob);
            }
        }

        echo "</pre></div>";

        if ($exitOnPrint) {
            exit;
        }
    }
}



