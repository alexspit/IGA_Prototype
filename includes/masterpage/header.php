<?php 
ob_start();
require_once 'core/init.php';

//require_once 'classes/GeneticAlgorithm.php';
?>

<!DOCTYPE html>
<html lang="en"><!--Setting default language to English-->
    <head>
        <title>Interactive Genetic Algorithm</title>
        
        <meta charset="utf-8">    
        <meta name="description" content="Lorem Ipsilum">
        <meta name="keywords" content="GA IGA">
        <meta name="author" content="Alexander Spiteri">

        <!--Main CSS-->
        <link rel='stylesheet' type='text/css' href='css/iga_style.css' />
        <link rel='stylesheet' type='text/css' href='css/bootstrap.css' />
        <link rel='stylesheet' type='text/css' href='css/font-awesome.css' />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:i|Tangerine:b|Inconsolata|Droid+Sans">
        <link rel='stylesheet' type='text/css' href='css/normalize.css' />
        <link rel='stylesheet' type='text/css' href='css/ion.rangeSlider.css' />
        <link rel='stylesheet' type='text/css' href='css/ion.rangeSlider.skinHTML5.css' />
        <link rel="stylesheet" type='text/css' href="css/ion.zoom.css"/>


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
