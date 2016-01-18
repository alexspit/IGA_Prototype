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

    $crossedPopulation = $ga->crossover($evaluatedPopulation);
    //$crossedPopulation = $ga->crossoverSinglePoint($evaluatedPopulation, Selection::ROULETTE);

    $mutatedPopulation = $ga->mutate($crossedPopulation);
    //$mutatedPopulation = $ga->mutateUniform($crossedPopulation);



}