<?PHP
require_once 'dbconnect.php';


//CHeck file size is under 5 MB
if ($_FILES["photo"]["size"] > 5000000) {
   
   	echo json_encode(array (
			"status" => 0,
			"message" => "File size too large, images must be 5MB or less" 
				
	));
		
	exit();
    

 }

//set upload directory and variables from POST and FIELS
$uploadDir = '/home/naturestwist/public_html/photos/';
$fileName = $_FILES['photo']['name'];
$tmpName = $_FILES['photo']['tmp_name'];
$name = $_POST['name'];
$email = $_POST['email'];
$story = $_POST['story'];
$ext = substr(strrchr($fileName, "."), 1); 
$from = 'info@natures-twist.com';
$subject = "Thank you for sending us your Nature's Twist photo";
$body = "We got your Photo!  Thanks so much for sharing.  We will take a look and review your story.  Check back to http://www.natures-twist.com soon to see if you have been featured as representing the Nature's Twist lifestyle.";
$to = $_POST['email'];
$headers = 'From: ' . $from . ' ' . "\r\n" .
				'Reply-To: ' . $from . ' ' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

//test to make sure the extension is a supported tpye (any type you match against can be a supported image type)
if ($ext != "png" && $ext != "jpg" && $ext != "jpeg" && $ext != "gif") {
		
		echo json_encode(array (
			"status" => 1,
			"message" => "Unsupported File Type, accepted file types include PNG, JPG, JPEG and GIF" 
				
		));
	exit();
}

//make the file name random to prevent overwriting files with the same name
$randName = md5(rand() * time());
$filePath = $uploadDir . $randName . '.' . $ext;
$result = move_uploaded_file($tmpName, $filePath);
		
		if (!$result) {
			echo json_encode(array (
			"status" => 2,
			"message" => "SNAP!, the server had a problem handling you file, we are sorry, please try again soon" 
				
		));
			exit();
		}

		if(!get_magic_quotes_gpc())
		{
			$fileName = addslashes($fileName);
			$filePath = addslashes($filePath);
		}

//save the results to the database
$conn = classes_utils_dbconnect::createDBConnection();
$sql = "INSERT INTO photouploads (name,email, story, path) VALUES (:name,:email, :story, :path)";
$q = $conn->prepare($sql);

		try {
			$q->execute(array(':name'=>$name,':email'=>$email, ':story'=>$story, ':path'=>$filePath));

			
					if (mail ($to, $subject, $body, $headers)) {
					
						echo json_encode(array (
							"status" => 3,
							"message" => "You submission was sent.  Thanks for being a fan of Nature's Twist!"
						));

						exit();

					}
					else {

						echo json_encode(array (
							"status" => 4,
							"message" => "A server error occured, please try again later"
						));
						
							exit();
					}




			


		}
		catch (Exception $e) {


			echo json_encode(array (
			
				
				"status" => 5,
				"message" => "Snap!, the server has an error, please try again in a little bit" . " " . $e 

				
		));
			exit();


		}
	

	


	



?>