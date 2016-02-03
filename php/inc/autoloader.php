<?php
function replaceunderscores ($classname) {
	$path = str_replace('_', DIRECTORY_SEPARATOR, $classname);
	$fullpath = "../".$path.".php";
	
	if (file_exists($fullpath))  {

		require_once ($fullpath);
	}
	else {
		echo "could not find file \n";
	}
}

?>