<?php

//header-----------------------------------------
header('Content-Type: application/json');
require_once '../inc/autoloader.php';
spl_autoload_register('replaceunderscores');
//------------------------------------------------

$thestreet = $_REQUEST['street'];
$theCity = $_REQUEST['city'];
$theState = $_REQUEST['state'];
$theZip = $_REQUEST['zip'];

$address = $thestreet . " ". $theCity. " ". $theState . " " .$theZip;



$coord = classes_utils_getLatLng::getCoord($address);

echo json_encode($coord);

?>