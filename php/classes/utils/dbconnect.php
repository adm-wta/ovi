<?php

class classes_utils_dbConnect {
	
	const CONSTR = 'mysql:host=pbv-webapps01;dbname=naturestwist-test';
	const USER = 'naturestwist';
	const PASS = 'Oitnb1';
	
	public function __construct() {
	
	}
	
	static function createDBConnection() {
		
		
		try
		{
		
			$conn = new PDO(self::CONSTR,self::USER, self::PASS);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		
		}
		catch(PDOException $e)
		{
		
			$err = "A connection could not be made to the database\n" . $e->getMessage();
			self::showError($err);
			return;
		}
	}
	
	private function showError ($err) {
		
		echo $err;
	}
	
	
}






?>