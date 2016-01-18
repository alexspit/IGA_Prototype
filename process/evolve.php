<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 11:32 PM
 */

require_once "../core/init_process.php";


if($_POST) {

    $ratings = $_POST;
    $user_id = $_SESSION['user_id'];
    $ga = new GeneticAlgorithm($user_id);



    $currentPopulation = $ga->currentPopulation();

    $evaluatedPopulation = $ga->evalPopulation($currentPopulation, $ratings);
/*
    foreach ($evaluatedPopulation->getIndividuals() as $i) {
        echo $i."<br>";
    }

    echo "------------------------------------<br>";*/

    $crossedPopulation = $ga->crossoverSinglePoint($evaluatedPopulation, Selection::ROULETTE);
/*
    foreach ($crossedPopulation->getIndividuals() as $i) {
        echo $i."<br>";
    }

    echo "------------------------------------<br>";*/
    $mutatedPopulation = $ga->mutateUniform($crossedPopulation);

   /* foreach ($mutatedPopulation->getIndividuals() as $i) {
        echo $i."<br>";
    }*/

}