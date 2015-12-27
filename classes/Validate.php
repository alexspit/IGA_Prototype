<?php

class Validate {
    
    private $_passed = false,
            $_errors = array(),
            $_db = null;
    
    public function __construct() {
        $this->_db = DB::getInstance();
    }
    
    public function check($source, $items = array()){
        
        foreach($items as $item => $rules){//Looping through the items
            foreach($rules as $rule => $rule_value){//Looping through the rules
                 //echo "$item $rule must be $value";
                $value = trim($source[$item]);
                $item = escape($item);
                
                //First check if value exists
                if($rule === 'required' && empty($value)){
                    $this->addError("$item is required");
                }
                else if(!empty($value)){
                    switch ($rule) {
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("$item must be a minimum of $rule_value characters.");
                               
                            }

                            break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("$item must be a maximum of $rule_value characters.");
                              
                            }

                            break;
                        case 'matches':
                            if($value != $source[$rule_value]){
                                $this->addError("$rule_value must match $item.");
                               
                            }

                            break;
                        case 'unique':
                            $check = $this->_db->query("SELECT * FROM $rule_value WHERE $item = ?", array($value));
                            if($check->count()){
                                $this->addError("$item already exists.");
                               
                            }

                            break;
                        case 'isemail':
                            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                                $this->addError("$value is not a valid email address.");
                            
                            }

                            break;
                         case 'numeric':
                            if(!is_numeric($value)){
                                $this->addError("$value is not a number.");
                            
                            }

                            break;
                         case 'exists':
                            $check = $this->_db->query("SELECT * FROM $rule_value WHERE $item = ?", array($value));
                                                          
                            if(!$check->count()){
                                if ($rule_value == "user"){
                                $this->addError("No registered account has the $item you entered.");
                                }
                                else if ($rule_value == "shared_file"){
                                $this->addError("No shared file found with that $item.");
                                }
                               
                            }


                            break;
                            
                        default:
                            break;
                    }
                    
                }
            }
            
        }
        
        if(empty($this->_errors))
        {
            $this->_passed = true;
        }
        
        return $this;
    }
    
    private function addError($error){
        $this->_errors[] = $error;
    }
    
    public function errors(){
        return $this->_errors;
    }
           
    public function passed(){
        return $this->_passed;
    }
}
