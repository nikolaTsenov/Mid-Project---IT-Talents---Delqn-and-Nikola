<?php

if (isset ( $_POST ['delete'] ) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	// get the AJAX parameter:
	$delete = trim(htmlentities($_POST ['delete']));
	// array form:
	$deleteArr = explode("_",$delete); // -0:Comentor;1:commentNum;2:uploader;3:category;4:postTitle
	//directory of the comments:
	$commentsDir = "./users/" . $deleteArr[2] . "/upload/" . $deleteArr[3] . "/" . $deleteArr[4] . "Comments.txt";
	//comments in array form:
	$commentsContent = file($commentsDir);
	//Delete comment:
	unset ($commentsContent[$deleteArr[1]]);
	//put new content:
	file_put_contents($commentsDir, $commentsContent);
} else {
	header ( 'Location:index.php' );
}


?>