<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 11:32 PM
 */

require_once "../core/init_process.php";


if(Input::exists()) {


    $ratings = $_POST;
    $user_id = Session::get("user_id");
    $ga = new GeneticAlgorithm($user_id);

    $currentPopulation = $ga->currentPopulation();

    $evaluatedPopulation = $ga->evalPopulation($currentPopulation, $ratings);


    if($ga->terminationConditionMet()){

        if($ga->getCurrentSection() == Section::FOOTER){

            $ga->setSessionEnd();
            $fittestIndividual = $currentPopulation->getFittestIndividual(0);
            $ga->setSectionChromosome($fittestIndividual);

            Redirect::to("evolved_evaluation.php");
        }
        else if($ga->getCurrentSection() == Section::HEADER){

            $ga->setGenerationEnd();
            $fittestIndividual = $currentPopulation->getFittestIndividual(0);
            $ga->setSectionChromosome($fittestIndividual);

            $ga->setSection(Section::BODY);

            Redirect::to("initialize_section.php");
        }
        else if ($ga->getCurrentSection() == Section::BODY){

            $ga->setGenerationEnd();
            $fittestIndividual = $currentPopulation->getFittestIndividual(0);
            $ga->setSectionChromosome($fittestIndividual);
            $ga->setSection(Section::FOOTER);
            Redirect::to("initialize_section.php");
        }


    }
    else{

        $matingPool = $ga->selection($evaluatedPopulation);
        //echo "Mating Pool: $matingPool<br>";

        $crossedPopulation = $ga->crossover($matingPool);
        //echo "Crossed Population: $crossedPopulation<br>";

        $mutatedPopulation = $ga->mutate($crossedPopulation);
        //echo "Mutated Populations: ".$mutatedPopulation."<br>";


        $ga->nextGeneration($mutatedPopulation);

        Redirect::to("../iga_interface.php");

    }


}