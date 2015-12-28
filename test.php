<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28-Dec-15
 * Time: 15:55
 */




session_start();

require_once "core/init.php";



var_dump($_REQUEST);

echo "<br>";

$ga = new GeneticAlgorithm(10,0.8,0.01,1);

$population = unserialize($_SESSION['population']);

foreach ($population->getIndividuals() as $id => $i) {

    $id++;
    $individual = "individual_{$id}";
    $fitness = (int) $_POST[$individual];

    $i->setFitness($fitness);
}


$ga->evalPopulation($population);

echo $population->getPopulationFitness();




