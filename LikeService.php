<?php
if (isset ( $_POST ['tit'] ) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	// Value of the passed by AJAX parameter:
	$tit = trim(htmlentities($_POST ['tit']));
	// Preparing the passed by AJAX parameter for participating in the cookie name:
	$forbiddenSymbols = array(" ",";",",","=","\r","\n","\r\n","\t","&nbsp","'",'"');
	$titForCookie = str_replace($forbiddenSymbols, '', $tit);
	$titForCookie = preg_replace('/\s+/', '', $titForCookie);
	$titForCookie = preg_replace('/[\x00-\x1F\x7F]/u', '', $titForCookie);
	//echo $tit;
	// First check if the user is logged:
	session_start();
	if (!isset ( $_SESSION ['username'] )) {
		echo "Please, log in if you want to react to the posts of this site!";
	} else {
		// Preparation for setting a unique cookie name:
		$sessForCookie = $_SESSION ['username'];
		$sessForCookie = str_replace($forbiddenSymbols, '', $sessForCookie);
		$sessForCookie = preg_replace('/\s+/', '', $sessForCookie);
		$sessForCookie = preg_replace('/[\x00-\x1F\x7F]/u', '', $sessForCookie);
		// $titArray will help determine wether like or dislike is clicked and it will give all needed info about the post:
		$titArray = explode("_",$tit);
		// 0-klas; 1-title; 2-estension; 3-category; 4-username;
		
		// directory of the reactions for the post:
		if ($titArray[0] == "like1") {
			$directory = './users/' . $titArray[4] . '/upload/' . $titArray[3] . '/' . $titArray[1] . 'Likes.txt';
		} else {
			$directory = './users/' . $titArray[4] . '/upload/' . $titArray[3] . '/' . $titArray[1] . 'Dislikes.txt';
		}
		try {
			$reactionsHandle = fopen ( $directory,'a+' );
		}
		finally {
			fclose($reactionsHandle);
		}
		// Check if the user has cleared his/her browser cache:
		$posterReactorsFile = file_get_contents($directory);
		$participateInReactors = false;
		if (mb_strlen($posterReactorsFile,"UTF-8") > 0) {
			$posterReactorsFileArray = explode("#",$posterReactorsFile);
			for ($count = 0; $count < count($posterReactorsFileArray); $count++) {
				if ($posterReactorsFileArray[$count] == $_SESSION ['username']) {
					$participateInReactors = true;
				}
			}
		}
		
		$clearedBrowserCache = false;
		if (!isset($_COOKIE[$titForCookie . "_" . $sessForCookie]) && $participateInReactors) {
			$clearedBrowserCache = true;
		}
		//echo boolval($clearedBrowserCache) ? 'true' : 'false'; - for testing

		// End of cleared cache check.
		//Check if like or dislike is clicked for prevention of clicking both of them:
		if ($titArray[0] == "like1") {
			$alternativeTit = str_replace("like1", "dislike1", $tit);
		} else {
			$alternativeTit = str_replace("dislike1", "like1", $tit);
		}
		$alternativeTitForCookie = str_replace(' ', '', $alternativeTit);
		$alternativeTitForCookie = preg_replace('/\s+/', '', $alternativeTitForCookie);
		
		if (!isset($_COOKIE[$titForCookie . "_" . $sessForCookie]) && isset($_COOKIE[$alternativeTitForCookie . "_" . $sessForCookie])) {
			echo "You cannot simultaneosly like and dislike a post!";
		} else {
			// Set flag to show if the user now adds to the value of likes/dislikes or gets his like/dislike back:
			$cookieFlag = true;
			if ((!isset($_COOKIE[$titForCookie . "_" . $sessForCookie]) || $_COOKIE[$titForCookie . "_" . $sessForCookie] != 'liked') && !$clearedBrowserCache ) {
			
				setcookie($titForCookie . "_" . $sessForCookie, 'liked', 2147483647, "/");
				echo "cookie set";
			}
			if (isset($_COOKIE[$titForCookie . "_" . $sessForCookie]) && $_COOKIE[$titForCookie . "_" . $sessForCookie] == 'liked') {
				setcookie($titForCookie . "_" . $sessForCookie, "", time() - 3600, "/");
				echo "cookie unset";
				$cookieFlag = false;
			}
			// Increasing/Decreasing the value of likes/dislikes serverside:
			if ($titArray[2] == "mp4") {
				$pathString = "./users/videoteka.txt";
			} elseif ($titArray[2] == "gif") {
				$pathString = "./users/gifoteka.txt";
			} else {
				$pathString = "./users/gallery.txt";
			}
			$fileGallery = file_get_contents ( $pathString );
			
			$fileGalleryArray = explode(PHP_EOL,$fileGallery);
			array_pop($fileGalleryArray);
			
			for($index = 0; $index < count ( $fileGalleryArray ); $index ++) {
				$row = explode ( '#', $fileGalleryArray [$index] );
				if ($row[2] == $titArray[1] . "." . $titArray[2]) {
					if ($cookieFlag && !$clearedBrowserCache) {
						if ($titArray[0] == "like1") {
							$row[5]++;
						} else {
							$row[6]++;
						}
						// Opening a handle to remember the username of the user who has liked/disliked the post:
						try {
							$reactionsHandle = fopen ( $directory,'a+' );
						
							//Remembering the username who has liked this file:
							fwrite($reactionsHandle,$_SESSION ['username']);
							fwrite($reactionsHandle,'#');
						}
						finally {
							fclose($reactionsHandle);
						}
					} 
					if ($clearedBrowserCache || !$cookieFlag) {

						//$posterReactorsFile = file_get_contents($directory);
						$posterReactorsFileNewContent = str_replace($_SESSION ['username'] . "#", "", $posterReactorsFile);
						file_put_contents($directory, $posterReactorsFileNewContent);
						
						if ($titArray[0] == "like1") {
							if ($row[5] > 0) {
								$row[5]--;
							}
						} else {
							if ($row[6] > 0) {
								$row[6]--;
							}
						}
						if ($clearedBrowserCache) {
							echo "clearedCache";
						}
					}
					$newRow = implode ( '#', $row );
					$fileGalleryArray[$index] = $newRow;
				}
			}
			$newFileGallery = implode(PHP_EOL,$fileGalleryArray);
			//echo $newFileGallery;
			$newFileGallery .= PHP_EOL;
			
			file_put_contents($pathString, $newFileGallery);
			
		}
	}
	
} else {
	header ( 'Location:index.php' );
}

?>