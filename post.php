<?php

if(!$index) {
	header('Location:index.php?page=homepage');
	die();
}
// Don't allow to enter page directly:
if (isset($_GET['post'])) {
	$postString = trim(htmlentities($_GET['post']));
 	$postArr = explode("  ",$postString); // - 0:filename;1:fileExt;2:category;3:username; 
 	// Set necessary variables:
 	$fileTit = $postArr[0];
 	$fileExt = $postArr[1];
 	$fileCat = $postArr[2];
 	$fileUploader = $postArr[3];
 	// Set necessary paths in variables:
 	$fileSrc = "./users/" . $fileUploader . "/upload/" . $fileCat . "/" . $fileTit . "." . $fileExt;
 	$commentsSrc = "./users/" . $fileUploader . "/upload/" . $fileCat . "/" . $fileTit . "Comments.txt";
 	$likesSrc = "./users/" . $fileUploader . "/upload/" . $fileCat . "/" . $fileTit . "Likes.txt";
 	$dislikesSrc = "./users/" . $fileUploader . "/upload/" . $fileCat . "/" . $fileTit . "Dislikes.txt";
 	$profilePicSrc = file_get_contents("./users/" . $fileUploader . "/upload/profilePicture/profilePath.txt");
} else {
	// Send to homepage if directly enter:
	header('Location:index.php?page=homepage');
	die();
}

$validComment = true; // - is the comment a valid string flag
$problem = false; // - are there any problems with upload flag
$isLogged = true; // - is the user logged flag
if (isset($_POST['submitComment'])) {
	$msg = "";
	if (isset($_SESSION['username'])) {
		$newCom = trim(htmlentities($_POST['newComment']));
		$sessor = $_SESSION['username'];
		if (mb_strlen($newCom,"UTF-8") > 100 || mb_strlen($newCom,"UTF-8") < 1) {
			$msg = "Your comment cannot be less than 1 characters and more than 100 characters.";
			$validComment = false;
		}
		if (strpos($newCom,"#") == true) {
			$msg = "'#' is invalid symbol.";
			$validComment = false;
		}
		for ($count = 1; $count < mb_strlen($newCom,"UTF-8"); $count++) {
			if ($newCom{$count-1} == " " && $newCom{$count} == " ") {
				$msg = "You cannot have more than one blank space.";
				$validComment = false;
			}
		}
		if ($validComment) {
			if (file_exists($commentsSrc)) {
				// Record the new comment:
				try {
					$commentHandle = fopen($commentsSrc,"a+");
					fwrite($commentHandle,$sessor);
					fwrite($commentHandle,"#");
					fwrite($commentHandle,$newCom);
					fwrite($commentHandle,PHP_EOL);
				}
				finally {
					// Close the file after recording:
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
	<img src="./assets/images/uploadForm/bigSmile2.png" alt="Big Smile" align="middle" />
	<h2 id="advert">You can place your add here! <br /><br /> <a href="?page=contact">Contact us</a> </h2>
</aside>
<div id="postContain">
	<div id="postTit">
		<h4 id="postTitCont"><?php echo $fileTit; ?></h4>
		<h6 id="upBy">Uploaded by: <?php echo $fileUploader; ?></h6><div><img src="<?php echo $profilePicSrc; ?>" alt="<?php echo $fileUploader; ?>" /></div>
		<h6>Category: <?php echo $fileCat; ?></h6>
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
			<?php 
			// Get all comments in string form:
			$showCommentsString = file_get_contents($commentsSrc);
			// All comments in array form:
			$showComments = explode(PHP_EOL,$showCommentsString);
			array_pop($showComments);
			// Loop for showing all comments:
			for ($index = 0; $index < count($showComments); $index++) {
				// Setting a temprary array to keep the each username with his comment:
				$tempArr = explode("#",$showComments[$index]);
				// Get the path to the prof pic of the commentor:
				$userPicDir = "./users/" . $tempArr[0] . "/upload/profilePicture/profilePath.txt";
				if (file_exists($userPicDir)) {
					$userPic = file_get_contents($userPicDir);
				} else {
					$userPic = "no such file";
				}
			?>
				<div id="<?php echo $tempArr[0] . "+" . $index . "+" . $fileUploader . "+" . $fileCat . "+" . $fileTit; ?>" class="comDiv">
					<div class="imgDiv">
						<img src="<?php if (file_exists($userPic)) {echo $userPic;} else { echo "./assets/images/galleryImages/noPic.jpeg"; } ?>" alt="<?php echo $fileUploader . $index; ?>" />
					</div>
					<p><?php echo $tempArr[1]; ?></p>
					<?php 
					if (isset($_SESSION['username']) && ($_SESSION['username'] == $tempArr[0] || $_SESSION['username'] == "TheCheerer")) {
					?>
					<button class="deleteButton" id="<?php echo $tempArr[0] . "_" . $index . "_" . $fileUploader . "_" . $fileCat . "_" . $fileTit; ?>" onclick="deleteThisComment(this.id)" >Delete</button>
					<?php 
					}
					?>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>
<aside id="theRight">
	<h4 id="wholikedIt">People who <i class="fa fa-thumbs-up" aria-hidden="true"></i> this post:</h4>
	<?php 
		if (file_exists($likesSrc) && filesize($likesSrc) > 0) {
			// Get all likers in string form:
			$showLikersString = file_get_contents($likesSrc);
			// All likers in array form:
			$showLikers = explode("#",$showLikersString);
			array_pop($showLikers);
			// Loop for showing all likers:
			for ($index = 0; $index < count($showLikers); $index++) {
				$likerProfPicDir = "./users/" . $showLikers[$index] . "/upload/profilePicture/profilePath.txt";
				if (file_exists($likerProfPicDir)) {
					$likerProfPic = file_get_contents($likerProfPicDir);
				} else {
					$likerProfPic = "no such file";
				}
	?>
				<div id="likers">
					<div id="liker">
						<img src="<?php if (file_exists($likerProfPic)) {echo $likerProfPic;} else { echo "./assets/images/galleryImages/noPic.jpeg"; } ?>" alt="<?php echo $showLikers[$index]; ?>" />
					</div>
					<p><?php echo $showLikers[$index]; ?></p>
				</div>
	<?php
			}
		} else {
			echo "<p id='notYetLiked'>Noone has yet liked this post</p>";
		}
	?>
	<h4 id="whodislikedIt">People who <i class="fa fa-thumbs-down" aria-hidden="true"></i> this post:</h4>
	<?php 
		if (file_exists($dislikesSrc) && filesize($dislikesSrc) > 0) {
			// Get all likers in string form:
			$showDislikersString = file_get_contents($dislikesSrc);
			// All likers in array form:
			$showDislikers = explode("#",$showDislikersString);
			array_pop($showDislikers);
			// Loop for showing all likers:
			for ($index = 0; $index < count($showDislikers); $index++) {
				$dislikerProfPicDir = "./users/" . $showDislikers[$index] . "/upload/profilePicture/profilePath.txt";
				if (file_exists($dislikerProfPicDir)) {
					$dislikerProfPic = file_get_contents($dislikerProfPicDir);
				} else {
					$dislikerProfPic = "no such file";
				}
	?>
				<div id="dislikers">
					<div id="disliker">
						<img src="<?php if (file_exists($dislikerProfPic)) {echo $dislikerProfPic;} else { echo "./assets/images/galleryImages/noPic.jpeg"; } ?>" alt="<?php echo $showLikers[$index]; ?>" />
					</div>
					<p><?php echo $showDislikers[$index]; ?></p>
				</div>
	<?php
			}
		} else {
			echo "<p id='notYetdisLiked'>Noone has yet disliked this post</p>";
		}
	?>
</aside>
<script src="./assets/javascript/post.js" ></script>