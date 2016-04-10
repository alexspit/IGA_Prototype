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


    $request  = $client->getMessageFactory()->createCaptureRequest('http://localhost/IGA_Prototype/individual_screenshot.php');
    $response = $client->getMessageFactory()->createResponse();

    $file = 'thumbnails/screenshot.jpg';

    $top    = 0;
    $left   = 0;
    $width  = 1920;
    $height = 1200;

    $request->setViewportSize($width, $height);
    $request->setCaptureDimensions($width, $height, $top, $left);
   // $request->setDelay(200);

    $request->setOutputFile($file);

    $client->send($request, $response);


