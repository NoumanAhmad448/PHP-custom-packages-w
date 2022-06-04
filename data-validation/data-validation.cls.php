<?php 

class DataValidator{

    private static $ruleList = array('hasData', 'isString', 'isInteger', 'isBoolean', 'isArray', 'containHTML',
                                    );
    private static $response = array();
    private static $resParams = array('isValidation', 'detail');

    /**********************************************************************************************************
     * 
     * @description
     * validate the data provided by the user
     * 
     * @signature
     * validator($data : any, $rules: array): array
     * 
     * @param mixed: $data, array: $rules
     * $data can be of any type
     * $rules must be given in array. if rule message needs to be customized, you must provide $rules as assosiative array
     * while containing rule as key and the message as a value
     * 
     * @return Array 
     * containing isValidated and detail keys. isValidated will be boolean value while details will consist of message
     * if there is any data validation fail
     * 
     * @author Nouman Ahmad 
     * 
     *********************************************************************************************************/
    public static function validator($data,$rules){        
        if(self::isArray($rules) && count($rules) !== 0){
            // verify given rules
            $extra_rules = self::verifyGivenRules($rules);
            if($extra_rules){
                self::$response[self::$resParams[1]]['notAllowedRules'] = $extra_rules;
                return self::setErrorMessage(false,'given rules are not in the list');            
            }
            
            // validating the rules
            // if error msg is provided by user then index = rule and rule = errMsg 
            // else rule is rule however system generated error message will be sent
            
            foreach($rules as $index => $rule){                
                $errMsg = '';
                if(is_string($index)){
                    $errMsg = $rule;
                    $rule = $index;
                }

                $methodToBeCalled = $rule."Validation";                
                if(self::$methodToBeCalled($data, $errMsg) === false){
                    return self::$response;
                }
            }

            return self::setSuccessMessage();

        }else{
            return self::setErrorMessage(false,'empty array as a second param is not allowed');            
        }
    }


    private function hasDataValidation($data, $errMsg){
        $doesNotFail = true;
        if($data == "") $doesNotFail = false;

        if($data === false || $data === 0 || $data === 0.0 || $data ==='0' || $data === 'false'){
            $doesNotFail = true;
        }else{
            if(empty($data)) $doesNotFail = false;
        }
          
        if($doesNotFail === false){
            self::setErrorMessage($doesNotFail, empty($errMsg) ? "object does't include any data" : $errMsg);
            return $doesNotFail;
        }
        return $doesNotFail;
    }

    private static function isArray($data){
        return is_array($data);
    }

    /***
     * @return true if given rules are in the given list
     * otherwise return an array of rules that are not allowed
     */
    private static function verifyGivenRules($rules){
        $extraRules = array();
        foreach ($rules as $index => $rule){
            if(is_string($index)){
                $rule = $index;
            }

            if(! in_array($rule,self::$ruleList)){
                array_push($extraRules, $rule);
            }
        }
        return count($extraRules) > 0 ? $extraRules : false;
    }

    private static function setErrorMessage($isValidate, $msg){
        self::$response[self::$resParams[0]] = $isValidate;
        self::$response[self::$resParams[1]]['err'] = $msg;
        return self::$response; 
    }

    private static function setSuccessMessage(){
        self::$response[self::$resParams[0]] = true;
        self::$response[self::$resParams[1]] = array();
        return self::$response; 
    }

    private static function isStringValidation($data, $errMsg){
          
        if(is_string($data) === false){
            self::setErrorMessage(false, empty($errMsg) ? "object must be string" : $errMsg);
            return false;
        }
        return true;
    }
    private static function isIntegerValidation($data, $errMsg){
          
        if(is_integer($data) === false){
            self::setErrorMessage(false, empty($errMsg) ? "object must be integer" : $errMsg);
            return false;
        }
        return true;
    }
    private static function isBooleanValidation($data, $errMsg){
          
        if(is_bool($data) === false){
            self::setErrorMessage(false, empty($errMsg) ? "object must be boolean" : $errMsg);
            return false;
        }
        return true;
    }

    private static function isArrayValidation($data, $errMsg){          
        if(is_Array($data) === false){
            self::setErrorMessage(false, empty($errMsg) ? "object does't include any data" : $errMsg);
            return false;
        }
        return true;
    }
    private static function containHTMLValidation($data, $errMsg){          
        if(strip_tags($data) !== $data){
            self::setErrorMessage(false, empty($errMsg) ? "object can't have html in it" : $errMsg);
            return false;
        }
        return true;
    }
    
}