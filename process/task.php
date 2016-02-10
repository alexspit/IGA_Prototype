<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2/8/2016
 * Time: 11:40 PM
 */

require_once "../core/init_process.php";

if(Input::exists('post')) {
    if (Token::check(Input::get('token'))) {//protection against CSRF


        $evaluation = new Evaluation(Session::get('user_id'), Input::get('type'));

        $task = $evaluation->getTask(Input::get('task'));

        $task->setEvaluationId($evaluation->getEvaluationID());

        $task->update(Input::get('total_time'), Input::get('straight_dist'), Input::get('travelled_dist'), Input::get('seq_score'), Input::get('completed'),
            Input::get('wrong_clicks'), Input::get('width'));

        if($task->getNumber() == $evaluation->getTaskCount()){
            $evaluation->setSessionEnd();

            if($evaluation->getType() == Evaluation::ORIGINAL){

                Redirect::to('../configuration.php');
            }
            else{

                Redirect::to('../thankyou.php');
            }
        }

        $taskNum = $task->getNumber() + 1;

        Redirect::to("../individual_evaluation.php?type={$evaluation->getType()}&task=$taskNum");


    }
}