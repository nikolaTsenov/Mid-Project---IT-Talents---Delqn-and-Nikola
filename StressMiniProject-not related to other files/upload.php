<?php
if (isset ( $_POST ["submit"] )) {
	
	$name = trim ( htmlentities ( $_POST ['name'] ) );
	$email = trim ( htmlentities ( $_POST ["email"] ) );
	$age = trim ( htmlentities ( $_POST ['age'] ) );
	$relationShip = trim ( htmlentities ( $_POST ['relationshipStatus'] ) );
	$checkUpload = false;
	echo $email;
	// email validation
	if (! filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
		$checkEmail = false;
		echo "Invalid email format";
	} else {
		$checkEmail = true;
	}
	
	if (! preg_match ( "/^[a-zA-Z ]*$/", $name )) {
		$checkName = false;
		echo "Only letters and white space allowed in Name";
	} else {
		$checkName = true;
	}
	
	// age validation
	if ($age < 6 || $age > 80) {
		$checkAge = false;
		echo "Invalid age";
	} else {
		$checkAge = true;
	}
	
	// relationship validation
	if (($_POST ['relationshipStatus'] === "single") || ($_POST ['relationshipStatus'] === "married")) {
		$checkRelationShip = true;
	} else {
		$checkRelationShip = false;
	}
	
	// UPLOAD
	$target_dir = "uploads/";
	$target_file = $target_dir . basename ( $_FILES ["fileToUpload"] ["name"] );
	$path = $target_file;
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
			} elseif (($checkEmail === true) && ($checkName === true) && ($checkAge === true) && ($checkRelationShip === true)) {
				if (move_uploaded_file ( $_FILES ["fileToUpload"] ["tmp_name"], $target_file )) {
					echo "The file " . basename ( $_FILES ["fileToUpload"] ["name"] ) . " has been uploaded.";
					$checkUpload = true;
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}
		} else {
			echo "You have to choose file for upload";
		}
		
		// name validation
		$null = null;
		if (($checkEmail === true) && ($checkName === true) && ($checkAge === true) && ($checkUpload === true) && ($checkRelationShip === true)) {
			
			$servername = "localhost";
			$username = "root";
			$password = "";
			
			//$email = mysql_real_escape_string($email);
			
			// Create connection
			$conn = mysqli_connect ( $servername, $username, $password );
			// Check connection
			if (! $conn) {
				die ( "Connection failed: " . mysqli_connect_error () );
			}
			
			//Create database
// 			if (mysql_select_db ( 'users', $conn )) {
// 				echo "databse exists";
// 			} else {
				$sql = "CREATE DATABASE IF NOT EXISTS users";
				
				if (mysqli_query ( $conn, $sql )) {
					echo "Database created successfully";
				} else {
					echo "Error creating database: " . mysqli_error ( $conn );
				}
				$sql = "CREATE TABLE IF NOT EXISTS users.people (
					  `id` INT NOT NULL AUTO_INCREMENT,
					  `name` VARCHAR(45) NOT NULL,
					  `emaill` VARCHAR(45) NOT NULL,
					  `years` INT NOT NULL,
					  `status` VARCHAR(10) NOT NULL,
					  `path` VARCHAR(400) NOT NULL,
					  PRIMARY KEY (`id`),
					  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
					  UNIQUE INDEX `emaill_UNIQUE` (`emaill` ASC))";
				if (mysqli_query ( $conn, $sql )) {
					echo "TABLE created successfully";
				} else {
					echo "Error creating TABLE: " . mysqli_error ( $conn );
				}
				
				// Escape user inputs for security
				$name = mysqli_real_escape_string($conn, $_REQUEST['name']);
				$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
				$age = mysqli_real_escape_string($conn, $_REQUEST['age']);
				$relationShip = mysqli_real_escape_string($conn, $_REQUEST['relationshipStatus']);
				
				$sql = "INSERT INTO users.people (name, emaill, years, status, path)
				VALUES ('$name', '$email', '$age', '$relationShip', '$path')";
				if (mysqli_query ( $conn, $sql )) {
					echo "Row insert successfully";
				} else {
					echo "Error insert the row " . mysqli_error ( $conn );
				}
				
				mysqli_close ( $conn );
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
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Upload</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<style>
		body {
			background-color: #efeeed;
			font-family: 'Open Sans', sans-serif;
			font-size: 1em;
		}
		a {
			text-decoration: none;
			color: #4286f4;
			padding: 0.3em;
			border: 1px solid #4286f4;
			border-radius: 30%;
		}
		a:hover, a:active {
			padding: 0.5em;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<br />
	<br />
	<br />
	<a href="./index.php" id="backBut" >Go to main page</a>
</body>
</html>

