<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 1:16 PM
 */
require_once "../core/init_process.php";

if(Session::exists("user_id")) {
    $user_id = Session::get("user_id");
    $ga = new GeneticAlgorithm($user_id);

    $ga->initGeneration();
    $ga->initPopulation();

    Redirect::to("../iga_interface.php");

}


