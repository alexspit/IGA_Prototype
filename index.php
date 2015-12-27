<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24-Dec-15
 * Time: 23:04
 */

include_once "includes/masterpage/header.php"; ?>

    <h1>Give an Aesthetic Rating to each title</h1>


<?php

$element = new Element("h1", 1);

$element->addProperty(new Property(1, "color", ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]));
$element->addProperty(new Property(2, "text-align", ["center", "left", "right", "justified"]));
$element->addProperty(new Property(3, "text-decoration", ["overline", "underline", "line-through"]));
$element->addProperty(new Property(4, "font-family", ["Tangerine", "Inconsolata", "Droid Sans"]));
$element->addProperty(new Property(5, "font-style", ["normal", "italic", "oblique"]));
$element->addProperty(new Property(6, "font-weight", ["normal", "lighter", "bold"]));
$element->addProperty(new Property(7, "letter-spacing", ["-3px", "-2px", "-1px", "0px", "1px", "2px", "3px"]));
$element->addProperty(new Property(7, "background-color", ["#1abc9c", "#16a085", "#f1c40f", "#f39c12", "#40d47e", "#27ae60", "#e67e22", "#d35400", "#3498db", "#2980b9", "#e74c3c", "#c0392b", "#9b59b6", "#8e44ad", "#ecf0f1", "#bdc3c7", "#34495e", "#2c3e50", "#95a5a6","#7f8c8d"]));


$population = new Population(6, $element);

$individuals = $population->getIndividuals();

function decode($id, Individual $individual, Element $element){

    $cssCode = "{$element->getCssTag()}#individual{$id} {".PHP_EOL;
    $chromosome = $individual->getChromosome()->toArray();
    $geneIndex = 0;

    foreach ($element->getProperties() as $property) {

        if($property->getCssName() == "font-family"){
            $cssCode .= "{$property->getCssName()} : '{$property->getValue($chromosome[$geneIndex])}', serif; ";
        }else{
            $cssCode .= "{$property->getCssName()} : {$property->getValue($chromosome[$geneIndex])}; ";
        }

        $geneIndex++;
    }
    $cssCode .= "}";

    return $cssCode;

}
//Test

/*
    $ga = new GeneticAlgorithm(25, 0.95, 0.01, 3);

    $population = $ga->initPopulation(30);

    $ga->evalPopulation($population);
	
	$generation = 1;

    while($ga->isTerminationConditionMet($population) == false){

        echo "Generation: $generation ";
        echo "Average fitness: ".$population->getPopulationFitness()/$population->size()." ";
        echo "Fittest Individual: ".$population->getFittestIndividual(0)->getFitness()."<br>";

        $population = $ga->crossoverUniform($population, GeneticAlgorithm::TOURNAMENT,5);

	    $population = $ga->mutate($population);

        $ga->evalPopulation($population);

        $generation++;
    }

    echo "Found solution is $generation generations.<br>Best solutions: ".$population->getFittestIndividual(0);
*/

/*
 for($i = 0; $i<20;$i++){

     //echo Random::generate();

    echo Random::generate().PHP_EOL;

     $length = 10;

     $swapPoint1 = rand(1,$length-3);

     $swapPoint2 = rand($swapPoint1+1, $length-2);

     echo $swapPoint1." ".$swapPoint2."<br>";

 }*/


//Printing Style
echo "<style>";
foreach ($individuals as $id => $individual) {

    echo "\n".decode($id+1, $individual, $element);
}
echo "</style>";

//
foreach ($individuals as $id => $individual) {
    $id++;
    echo "Encoded: ".$individual."<br>";
    echo "Decoded: <h1 id='individual{$id}'>This is a Title</h1>";
    echo '<div class="range-slider">
            <input class="input-range" type="range" value="5" min="1" max="10">
            <span class="range-value"></span>
          </div>';
}


?>


<?php include_once "includes/masterpage/footer.php "; ?>