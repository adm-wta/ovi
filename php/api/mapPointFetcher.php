<?php



//header-----------------------------------------
header('Content-Type: application/json');
require_once '../inc/autoloader.php';
spl_autoload_register('replaceunderscores');
//------------------------------------------------

//get current lat and long from ajax call
$lng = strval(round($_REQUEST['lng'], 6));
$lat = strval(round($_REQUEST['lat'], 6));
$markers = array();

//get a DB Connection
$conn = classes_utils_dbconnect::createDBConnection();

//query db for locations within the specified range
$stmt = $conn->prepare("SELECT locationid, name, address , lat, lng,( 3959 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distance FROM locations HAVING distance < 10 ORDER BY distance LIMIT 0 , 20");
$stmt->execute(array($lat, $lng, $lat));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($rows);


?>