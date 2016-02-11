<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2/10/2016
 * Time: 6:50 PM
 */

require_once "../core/init_process.php";

if(Input::exists('post')) {
    if (Token::check(Input::get('token'))) {//protection against CSRF

        if(Session::exists('type')){


            $susScore = Input::get('q1') + Input::get('q2') + Input::get('q3') + Input::get('q4') + Input::get('q5') +
                Input::get('q6') + Input::get('q7') + Input::get('q8') + Input::get('q9') + Input::get('q10');
            $susScore *= 2.5;

            $evaluation = new Evaluation(Session::get('user_id'), Session::get('type'));

            if($evaluation->setSusScore($susScore)){
                if(Session::get('type') == Evaluation::ORIGINAL){
                    Redirect::to('../configuration.php');
                }
                else{
                    $evaluation->setPreferred(Input::get('preference'), Input::get('comment'));
                    Redirect::to('../thankyou.php');
                }
            }
        }


    }
}