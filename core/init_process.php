<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 1:37 PM
 */

//Allow user to set sessions
if (session_status() == PHP_SESSION_NONE)
{
    session_start();

}

require_once '../vendor/autoload.php';
//Autoloading classes instead of using require once every time. Only load classes used.
//Pass a function that runs everytime a class is accessed
spl_autoload_register(function($class){
    //echo 'IGA_Prototype/classes/'. $class .'.php';


    require_once '../classes/'. $class .'.php';


});

//Require functions
//require_once '/IGA_Prototype/functions/sanitize.php';


//Setting global configuration settings to be used by the config class
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'igaDB'
    )
);

date_default_timezone_set('Europe/Berlin');