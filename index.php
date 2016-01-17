<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24-Dec-15
 * Time: 23:04
 */


//session_start();


include_once "includes/masterpage/header.php";
//require_once "classes/GeneticAlgorithm.php";
?>

    <h1>Give an Aesthetic Rating to each title</h1>
    <form action="test.php" method="post" id="form1">

        <input type="submit" value="Submit">
    </form>




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

$user = new User();
$user->get(22);


//$ga = new GeneticAlgorithm(12,0,10, Selection::TOURNAMENT, 2, Crossover::UNIFORM, 0.85, Mutation::UNIFORM, 0.05, $user);

$ga = new GeneticAlgorithm();

$ga->init(12,0,10, Selection::TOURNAMENT, 2, Crossover::UNIFORM, 0.85, Mutation::UNIFORM, 0.05, $user);

$_SESSION['gaSession_id'] = $ga->getSessionID();

Redirect::to("test.php");
exit;

$population = $ga->initPopulation($element);

$individuals = $population->getIndividuals();

//Printing Style
echo "<style>";
foreach ($individuals as $id => $individual) {
    echo "\n".$ga->decode($id+1, $individual, $element);
}
echo "</style>";

//Printing headers
foreach ($individuals as $id => $individual) {
    $id++;
    echo "Encoded: ".$individual."<br>";
    echo "Decoded: <h1 id='individual{$id}'>This is a Title</h1>";
    echo '<input type="text" class="input_range" id="range_'.$id.'" form="form1" name="individual_'.$id.'" value="" />';
}

//TEMP:: Setting random fitness
foreach ($population->getIndividuals() as &$i) {
    $i->setFitness(Random::generate());
}

$ga->evalPopulation($population);

echo $population->getPopulationFitness()."<br>";

$_SESSION['population'] = serialize($population);


?>


<?php include_once "includes/masterpage/footer.php "; ?>