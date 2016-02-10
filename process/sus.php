<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2/10/2016
 * Time: 6:50 PM
 */

require_once "../core/init_process.php";

echo "<pre>";
var_dump($_POST);
echo "</pre>";

$susScore = Input::get('q1') + Input::get('q2') + Input::get('q3') + Input::get('q4') + Input::get('q5') + Input::get('q6') + Input::get('q7') +
    Input::get('q8') + Input::get('q9') + Input::get('q10');

echo $susScore*2.5;