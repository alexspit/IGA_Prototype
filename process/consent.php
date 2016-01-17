<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 1:16 PM
 */
require_once "../core/init_process.php";


if($_POST){

    /*TODO: -Check if filtered values or true or false before saving!!
    *       -Check for empty inputs
    *       -User token against CSRF
    */


    $args = [
        "name"      => FILTER_SANITIZE_STRING,
        "surname"   => FILTER_SANITIZE_STRING,
        "age"       => [    "filter"    => FILTER_VALIDATE_INT,
                            "flags"     => FILTER_NULL_ON_FAILURE,
                            "options"   => ["min_range" => 18, "max_range" => 120]
                       ],
        "sex"       => [    "filter"    => FILTER_VALIDATE_INT,
                            "flags"     => FILTER_NULL_ON_FAILURE,
                            "options"   => ["min_range" => 0, "max_range" => 1]
                       ],
        "consent"   => FILTER_VALIDATE_BOOLEAN
    ];

    $clean = filter_input_array(INPUT_POST, $args);

    if($clean["consent"]){
        $user = new User($clean["name"], $clean["surname"], $clean["age"], $clean["sex"]);
        $_SESSION["user_id"] = $user->getUserId();
        Redirect::to("../configuration.php");
    }
    else{
        echo "Cannot go forward without consent";
    }





}

