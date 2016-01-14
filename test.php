<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28-Dec-15
 * Time: 15:55
 */


require "core/init.php";



$user = new User();

$user->setName("Leli");
$user->setSurname("Spiteri");
$user->setAge(29);
$user->setSex("m");

$user->save();

var_dump($user->get($user->getUserId()));



?>





