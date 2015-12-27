<?php

class Session{
    //Checks if a session exists
    public static function exists($name){
        return (isset($_SESSION[$name]));
    }
    
    //Creates a session
    public static function put($name, $value){
        return $_SESSION[$name] = $value;//returns its value
    }
    
    //If session exists, delete it
    public static function delete($name){
        if(self::exists($name)){
            unset($_SESSION[$name]);
        }
    }
    
    //Return the value of a session
    public static function get($name){
        return $_SESSION[$name];
    }
    
    //Show message and delete it after page reload
    public static function flash($name, $string = ''){
        if(self::exists($name)){ //If it exists, get it and return it, and delete it
            $session = self::get($name);
            self::delete($name);
            return $session;
        }
        else{//If it doesn't exist, create
            self::put($name, $string);
           
        }
    }
    
   
    
}
