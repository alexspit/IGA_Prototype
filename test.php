<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28-Dec-15
 * Time: 15:55
 */


require "core/init.php";


/*
$user = new User();

$user->setName("Leli");
$user->setSurname("Spiteri");
$user->setAge(29);
$user->setSex(SEX::MALE);

$user->save();


$ga = new GeneticAlgorithm($_SESSION['gaSession_id']);

echo "<pre>";
var_dump($ga);
echo "</pre>";





$locus = 0;

$i = new Individual();

//Encoding
foreach ($GLOBALS["interface"] as $section => $sections) {

    foreach ($sections as $selector => $selectors) {

        foreach ($selectors as $property => $properties) {

            $randomIndex = rand(0,count($properties)-1);
            $i->setGene($locus, $randomIndex);
            echo "Chromosome[$locus] = $randomIndex ($selector{ $property: {$properties[$randomIndex]} }, Total properties = ".count($properties).")<br>";
            $locus++;
        }
    }
}

echo $i."<br>";

$css = "";
$geneIndex = 0;
//Decoding
foreach ($GLOBALS["interface"] as $section => $sections) {

    foreach ($sections as $selector => $selectors) {

        $css .= "$selector {".PHP_EOL;
        //echo "$selector {<br>".PHP_EOL;


        foreach ($selectors as $property => $properties) {

            foreach ($properties as $key => $value) {
                //echo "Key: $key Value: $value<br>";
                //echo $i->getGene($geneIndex)." at index: $geneIndex<br>";
                if($key == $i->getGene($geneIndex)){
                    //echo "Match!<br>";
                    $css .= "$property : $value;<br>".PHP_EOL;
                    break;
                }



            }

            $geneIndex++;

        }

        //echo "}<br>";
        $css .= "}".PHP_EOL;
    }
}

echo $css;*/

$json = file_get_contents("data.json");
echo "<pre>";
var_dump(json_decode($json, true));
var_dump($GLOBALS['interface']);
echo "</pre>";

