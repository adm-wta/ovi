<?php

		
		$name = $_POST['contactName'];
		$from = $_POST['contactEmail'];
		$tel = $_POST['contactPhoneNumber'];
		$subject = 'OVI Hydration: ' . $_POST['contactSubject'];
		$body = 'Contact Name: ' . $_POST['contactName'] . PHP_EOL . 'Contact Number: ' . $_POST['contactPhoneNumber'] . PHP_EOL . PHP_EOL . 'Comments: ' . $_POST['contactContent'];
		$to = 'ovi_info@ovihydration.us';
		
		
		$headers = 'From: ' . $from . ' ' . "\r\n" .
				'Reply-To: ' . $from . ' ' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
		


		if($from == "" ){

			echo '<div class="alert alert-danger">Please fill in your email</div>';
			die();

		}
		elseif($name == "")
		{

		echo '<div class="alert alert-danger">Please fill in your name</p></div>';
		die();

		}
		else
		{


		if (mail ($to, $subject, $body, $headers)) {
			//header("Location: /index.html");
			echo '<div class="alert alert-success">Your message has been sent!</div';
			die();
			
		} else {
			echo '<div class="alert alert-success">Oops! Sopmething wnet wrong</div>';
		}
	
}	
	
	
	
	
	 

?>