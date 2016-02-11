<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 1:16 PM
 */
require_once "../core/init_process.php";


if(Input::exists()){

    if(Token::check(Input::get('token'))) {//protection against CSRF

        /*TODO: -Check if filtered values or true or false before saving!!
        *       -Check for empty inputs
        *       -User token against CSRF
        */


        $args = [
            "name"      => FILTER_SANITIZE_STRING,
            "surname"   => FILTER_SANITIZE_STRING,
            "age"       => [    "filter"    => FILTER_VALIDATE_INT,
                                "flags"     => FILTER_NULL_ON_FAILURE,
                                "options"   => ["min_range" => 18, "max_range" => 80]
                           ],
            "sex"       => [    "filter"    => FILTER_VALIDATE_INT,
                                "flags"     => FILTER_NULL_ON_FAILURE,
                                "options"   => ["min_range" => 0, "max_range" => 1]
                           ],
            "consent"   => FILTER_VALIDATE_BOOLEAN
        ];

        $clean = filter_input_array(INPUT_POST, $args);

        if(is_null($clean["age"])){
            Session::flash("age-error","Only ages between 18 and 80 allowed");
            Redirect::to("../consent.php");
        }

        if($clean["consent"]){
            $user = new User($clean["name"], $clean["surname"], $clean["age"], $clean["sex"]);
            Session::put("user_id", $user->getUserId());

            if(Input::get('test_type') == "pre_test"){
                Session::put("test_type", "pre_test");
                Redirect::to("../configuration.php");
            }
            else if(Input::get('test_type') == "full_test"){
                Session::put("test_type", "full_test");
                Redirect::to("original_evaluation.php");
            }
            else{
                Session::flash("consent-error","Please re-enter your details");
                Redirect::to("../consent.php");
            }


        }
        else{
            Session::flash("consent-error","Please give consent to proceed");
            Redirect::to("../consent.php");
        }

    }

}