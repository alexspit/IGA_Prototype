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
*/


$ga = new GeneticAlgorithm($_SESSION['gaSession_id']);

echo "<pre>";
var_dump($ga);
echo "</pre>";


?>





