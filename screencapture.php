<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28-Dec-15
 * Time: 19:58
 */

require 'vendor/autoload.php';
require 'core/init.php';

use JonnyW\PhantomJs\Client;

$client = Client::getInstance();
$client->getEngine()->setPath(__DIR__.'/bin/phantomjs.exe');

//for($i=1;$i<=12;$i++){
    $request  = $client->getMessageFactory()->createCaptureRequest('http://localhost/IGA_Prototype/individual_interface_test.php?id=68');
    $response = $client->getMessageFactory()->createResponse();

    //$file = 'thumbnails/individual'.$i.'.jpg';
    $file = 'thumbnails/individual_68.jpg';

    $top    = 0;
    $left   = 0;
    $width  = 1400;
    $height = 875;

    $request->setViewportSize($width, $height);
    $request->setCaptureDimensions($width, $height, $top, $left);
   // $request->setDelay(200);

    $request->setOutputFile($file);

    $client->send($request, $response);


//}


Redirect::to("iga_interface.php");

/*
for($i=1;$i<=12;$i++){



        echo "<img width='250' src='thumbnails/individual".$i.".jpg'>";


}



$request  = $client->getMessageFactory()->createCaptureRequest('http://localhost/IGA_Prototype/individual_interface.php');
$response = $client->getMessageFactory()->createResponse();

$file = 'thumbnails/individual1.jpg';

$top    = 0;
$left   = 0;
$width  = 1400;
$height = 875;

$request->setViewportSize($width, $height);
$request->setCaptureDimensions($width, $height, $top, $left);
// $request->setDelay(200);

$request->setOutputFile($file);

$client->send($request, $response);


echo '<img src="thumbnails/individual1.jpg" />';
exit;*/