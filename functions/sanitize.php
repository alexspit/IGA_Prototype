<?php

/* 
 *Function to sanitize data going in and coming out of database
 */

function escape($string)
{
    $string = trim($string);//Removes spaces from front and back of string
    $string = stripslashes($string); //Removes backslashes which can be used to maliciausly alter the data
    $string = strip_tags($string);//Removes tabs
    
    //htmlentities is identical to htmlspecialchars, but it supports HTML characters
    //ENT_QUOTES escapes single and double quotes
    //3rd Param sets the charset
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}
