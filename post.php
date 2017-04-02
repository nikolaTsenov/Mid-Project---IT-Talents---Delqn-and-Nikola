<?php

if(!$index) {
	header('Location:index.php?page=homepage');
	die();
}

if (isset($_GET['post'])) {
	$postString = trim(htmlentities($_GET['post']));
 	$postArr = explode("  ",$postString); // - 0:filename;1:fileExt;2:category;3:username; 
 	
 	$fileTit = $postArr[0];
 	$fileExt = $postArr[1];
 	$fileCat = $postArr[2];
 	$fileUploader = $postArr[3];
 	$fileSrc = "./users/" . $fileUploader . "/upload/" . $fileCat . "/" . $fileTit . "." . $fileExt;
 	$commentsSrc = "./users/" . $fileUploader . "/upload/" . $fileCat . "/" . $fileTit . "Comments.txt";
 	$profilePicSrc = file_get_contents("./users/" . $fileUploader . "/upload/profilePicture/profilePath.txt");
} else {
	header('Location:index.php?page=homepage');
	die();
}

$validComment = true;
$problem = false;
$isLogged = true;
if (isset($_POST['submitComment'])) {
	$msg = "";
	if (isset($_SESSION['username'])) {
		$newCom = trim(htmlentities($_POST['newComment']));
		
		if (mb_strlen($newCom,"UTF-8") > 50 || mb_strlen($newCom,"UTF-8") < 3) {
			$msg = "Your comment cannot be less than 3 characters and more than 50 characters.";
			$validComment = false;
		}
		if (strpos($newCom,"#") == true) {
			$msg = "'#' is invalid symbol.";
			$validComment = false;
		}
		for ($count = 1; $count < mb_strlen($newCom,"UTF-8"); $count++) {
			if ($newCom{$count-1} == $newCom{$count}) {
				$msg = "You cannot have more than one blank space.";
				$validComment = false;
			}
		}
		if ($validComment) {
			if (file_exists($commentsSrc)) {
				try {
					$commentHandle = fopen($commentsSrc,"a+");
					fwrite($commentHandle,$fileUploader);
					fwrite($commentHandle,"#");
					fwrite($commentHandle,$newCom);
					fwrite($commentHandle,PHP_EOL);
				}
				finally {
					fclose($commentHandle);
				}
			} else {
				$msg = "Sorry couldn't upload your comment!";
				$problem = true;
			}
		}
	} else {
		$msg = "Please login if you want to commment!";
		$isLogged = false;
	}
}
?>

<aside id="theLeft">
	<h2 id="advert">You can place your add here!</h2>
</aside>
<div id="postContain">
	<div id="postTit">
		<h1 id="postTitCont"><?php echo $fileTit; ?></h1>
	</div>
	<div id="postCont">
		<div id="thisPostCont">
		<?php if (file_exists($fileSrc)) { 
				 if ($fileExt !== "mp4") { ?>
					<img src="<?php echo $fileSrc; ?>" alt="<?php echo $fileTit; ?>" />
			<?php } else { ?>
					<video width="100%" controls>
						<source src="<?php echo $fileSrc; ?>" type="video/mp4">
					</video>
		<?php 
				 }
			  } else {
		?>
			
					<p id="warning">Sorry couldn't load the graphic file.</p>
		<?php 
			  }
		?>
		</div>
	</div>
	<div id="postComments">
		<?php 
			if (!$validComment || $problem || !$isLogged) {
				echo "<p id='warning'>" . $msg . "</p>";
			}
		?>
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
			<textarea name="newComment" id="newComment" rows="3" placeholder="place a new comment here..."></textarea>
			<input type="submit" value="Comment" id="submitComment" name="submitComment" />
		</form>
		<div id="commented">
			
		</div>
	</div>
</div>
<aside id="theRight"></aside>
