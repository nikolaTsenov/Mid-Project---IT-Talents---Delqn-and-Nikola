<?php
if (isset ( $_POST ["submit"] )) {
	
	$name = trim ( htmlentities ( $_POST ['name'] ) );
	$email = trim ( htmlentities ( $_POST ["email"] ) );
	$age = trim ( htmlentities ( $_POST ['age'] ) );
	
	$matchPassword = true;
	$characters = true;
	$used = false;
	
	// email validation
	if (! filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
		$email = false;
		echo "Invalid email format";
	} else {
		$email = true;
	}
	
	// name validation
	if (! preg_match ( "/^[a-zA-Z ]*$/", $name )) {
		$name = false;
		echo "Only letters and white space allowed in Name";
	} else {
		$name = true;
	}
	
	// age validation
	if ($age < 6 || $age > 80) {
		$age = false;
		echo "Invalid age";
	} else {
		$age = true;
	}
	
	// UPLOAD
	$target_dir = "uploads/";
	$target_file = $target_dir . basename ( $_FILES ["fileToUpload"] ["name"] );
	$uploadOk = 1;
	$imageFileType = pathinfo ( $target_file, PATHINFO_EXTENSION );
	// Check if image file is a actual image or fake image
	if (isset ( $_POST ["submit"] )) {
		if (! empty ( $_FILES ["fileToUpload"] ["tmp_name"] )) {
			$check = getimagesize ( $_FILES ["fileToUpload"] ["tmp_name"] );
			if ($check !== false) {
				echo "File is an image - " . $check ["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
			
			// Check if file already exists
			if (file_exists ( $target_file )) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES ["fileToUpload"] ["size"] > 5000000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if ($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "gif" && $imageFileType != "GIF") {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
			} elseif (($email === true) && ($name === true) && ($age === true)) {
				if (move_uploaded_file ( $_FILES ["fileToUpload"] ["tmp_name"], $target_file )) {
					echo "The file " . basename ( $_FILES ["fileToUpload"] ["name"] ) . " has been uploaded.";
					$upload = true;
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}
		} else {
			echo "You have to choose file for upload";
		}
		
		if (($email === true) && ($name === true) && ($age === true) && ($upload === true)) {
			echo "Success!";
		}
	}
}
// database connection
// $servername = "localhost:8080";
// $username = "root";
// $password = "";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password);

// // Check connection
// if (!$conn) {
// die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully";
?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	