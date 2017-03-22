<?php 
// UPLOAD
$target_dir = "users/" . $username . "/upload/profilePicture/";
$txtFile = "users/" . $username . "/upload/profilePicture/profilePath.txt";
$target_file = $target_dir . basename ( $_FILES ["fileToUpload"] ["name"] );
$path = $target_file;
$uploadOk = 1;
$imageFileType = pathinfo ( $target_file, PATHINFO_EXTENSION );
$exist = false;

// Check if image file is a actual image or fake image
	if (! empty ( $_FILES ["fileToUpload"] ["tmp_name"] )) {
		$check = getimagesize ( $_FILES ["fileToUpload"] ["tmp_name"] );
		if ($check === false) {
			$uploadOk = 0;
			setMessage("File is not an image.");
		} 
	
		// Check if file already exists
		if (file_exists ( $target_file )) {
			$uploadOk = 0;
			setMessage("Sorry, file already exists.");
			$exist = true;
		}
		// Check file size
		if ($_FILES ["fileToUpload"] ["size"] > 5000000) {
			setMessage("Sorry, your file is too large.");
			$uploadOk = 0;
		}
		// Allow certain file formats
		if ($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "gif" && $imageFileType != "GIF") {
			setMessage("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			setMessage("Sorry, your file was not uploaded.");

			// if everything is ok, try to upload file
		} else  {
			if (move_uploaded_file ( $_FILES ["fileToUpload"] ["tmp_name"], $target_file )) {
				$msg =  "The file " . basename ( $_FILES ["fileToUpload"] ["name"] ) . " has been uploaded.";
				setMessage("$msg");
				$checkUpload = true;
				if(is_file($txtFile)) {
					$picturePath = file_get_contents($txtFile);
					if((!$exist) && (strlen($picturePath) > 0)){
						unlink("$picturePath");
					}
				}
				if(is_file($txtFile)) {
					unlink("users/" . $username . "/upload/profilePicture/profilePath.txt");
				}
				$activityHandle = fopen($txtFile ,'a+');
				fwrite($activityHandle, $target_file);
				fclose($activityHandle);
			} else {
				setMessage("Sorry, there was an error uploading your file.");
			}
		}
	} else {
		setMessage("You have to choose file for upload");
	}

	?>