<?php
if (isset ( $_POST ['del'] ) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	// get the AJAX parameter:
	$del = trim(htmlentities($_POST ['del']));
	// get the content of gallery.txt in form of array:
	$galleryContent = file("./users/gallery.txt");
	// explode the id of the requested for deletion post to get the valuable info:
	$delArr = explode("_",$del);
	//var_dump($delArr); - 0:notImportant; 1:filename; 2:fileExt; 3:category; 4:user;
	// Setting the requested line for deletion:
	$delSearchString = $delArr[4] . "#" . $delArr[1] . "#" . $delArr[1] . "." . $delArr[2] . "#" . $delArr[2] . "#" . $delArr[3];
	$delStrLen = mb_strlen($delSearchString,"UTF-8");

	// The deletion itself:
	for ($index = 0; $index < count($galleryContent); $index++) {
		$check = substr($galleryContent[$index], 0, $delStrLen);
		if ($check == $delSearchString) {
			unset ($galleryContent[$index]);
			break;
		}
	}
	// Put the new content in the file:
	file_put_contents("./users/gallery.txt", $galleryContent);
	
	// Delete the graphic content from the server:
	$directory1 = "./users/" . $delArr[4] . "/upload/" . $delArr[3] . "/" . $delArr[1] . "." . $delArr[2];
	$directory2 = "./users/" . $delArr[4] . "/upload/" . $delArr[3] . "/" . $delArr[1] . "Dislikes.txt";
	$directory3 = "./users/" . $delArr[4] . "/upload/" . $delArr[3] . "/" . $delArr[1] . "Likes.txt";
	$directory4 = "./users/" . $delArr[4] . "/upload/" . $delArr[3] . "/" . $delArr[1] . "Comments.txt";
	
	$dirArr = array ($directory1, $directory2, $directory3, $directory4);
	
	for ($index = 0; $index < count($dirArr); $index++) {
		if (file_exists($dirArr[$index])) {
			unlink ($dirArr[$index]);
		}
	}
	
} else {
	header ( 'Location:index.php' );
}

?>