<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2/8/2016
 * Time: 10:51 PM
 */

require_once "../core/init_process.php";

if(Session::exists('user_id')){

    $user = new User();
    $user = $user->get(Session::get('user_id'));

    $evaluation = new Evaluation();

    if($evaluation->init($user, Evaluation::ORIGINAL)){
        //$evaluation->saveTask(1);
        Redirect::to("../individual_evaluation.php?type=".Evaluation::ORIGINAL."&task=1");

    }


}