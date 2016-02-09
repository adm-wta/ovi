<?php

//header-----------------------------------------
header('Content-Type: application/json');
require_once '../utils/dbconnect.php';
//require_once '../../inc/autoloader.php';
//spl_autoload_register('replaceunderscores');
//------------------------------------------------

class classes_model_getLocationsInRange {
	
	public function __construct() {
	
	}
	
	static function getLocationsInRange($latitude, $longitude) {
		
		//get a DB Connection
		$conn = classes_utils_dbconnect::createDBConnection();
		
		//query db for locations within the specified range
		$stmt = $conn->prepare("SELECT id, ( 3959 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) ) AS distance FROM locations HAVING distance < 10 ORDER BY distance LIMIT 0 , 20");
		$stmt->execute(array($latitude, $longitude, $latitude));
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $rows;
	}
	
	
}