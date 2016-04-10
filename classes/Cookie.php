<?php

class Cookie{


    /**
     * Check if a cookie exists
     *
     * @param string $name The name of the cookie
     * @return bool If it exists or not
     */
    public static function exists($name){
        return (isset($_COOKIE[$name])) ? true : false;
    }

    /**
     * Return cookie value from name
     *
     * @param string $name The name of the cookie
     * @return mixed Cookie value
     */
    public static function get($name){
        return $_COOKIE[$name];
    }

    /**
     * Create a new cookie
     *
     * @param string $name Cookie Name
     * @param mixed $value Cookie Value
     * @param DateTime $expiry How long the cookie should be persisted
     * @return bool If created successfully
     */
    public static function put($name, $value, $expiry){
        if(setcookie($name, $value, time() + $expiry, '/')){
            return true;
        }
        return false;
    }

    /**
     * Delete a cookie
     *
     * @param string $name The name of the cookie to delete
     */
    public static function delete($name){
        self::put($name, '', time() -1);
    }
}
