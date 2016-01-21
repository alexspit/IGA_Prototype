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

    if($ga->terminationConditionMet()){

        $ga->setSessionEnd();
        $fittestIndividual = $currentPopulation->getFittestIndividual(0);

        Redirect::to("../individual_interface_test.php?id=".$fittestIndividual->getIndividualId());
    }
    else{

       $ga->stochasticUniversalSampling($evaluatedPopulation);


        $matingPool = $ga->selectParentRoulettePool($evaluatedPopulation);

        echo "$matingPool<br>";

        echo "<br>----------------------------<br>";
        $crossedPopulation = $ga->crossoverUniformPool($matingPool);

        echo "$crossedPopulation<br>";

        //exit;

       // $crossedPopulation = $ga->crossover($evaluatedPopulation);

        $mutatedPopulation = $ga->mutate($crossedPopulation);

        echo $mutatedPopulation."<br>";

        //$ga->nextGeneration($mutatedPopulation);

        //Redirect::to("../iga_interface.php");
    }


}