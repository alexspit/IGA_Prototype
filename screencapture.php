<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28-Dec-15
 * Time: 19:58
 */

require 'vendor/autoload.php';

use JonnyW\PhantomJs\Client;

$client = Client::getInstance();
$client->getEngine()->setPath(__DIR__.'/bin/phantomjs.exe');



for($i=1;$i<=12;$i++){
//$request  = $client->getMessageFactory()->createCaptureRequest('http://ironsummitmedia.github.io/startbootstrap-shop-homepage/');
    $request  = $client->getMessageFactory()->createCaptureRequest('file:///C:/Users/Alex/Google%20Drive/Middlesex/Thesis/Templates/startbootstrap-shop-homepage-1.0.4/index.html');
    $response = $client->getMessageFactory()->createResponse();

    $file = 'thumbnails/file'.$i.'.jpg';

    $top    = 0;
    $left   = 0;
    $width  = 1280;
    $height = 1000;

    $request->setViewportSize($width, $height);
    $request->setCaptureDimensions($width, $height, $top, $left);
   // $request->setDelay(200);

    $request->setOutputFile($file);

    $client->send($request, $response);


}

for($i=1;$i<=12;$i++){



        echo "<img width='250'  src='thumbnails/file".$i.".jpg'>";


}

exit;