<?php
// da ne moje da se otvori linka direktno
if(!$index) {
	header('Location:/7cheers/?page=upload');
	die();
}

$logged = true; //flag - no one not logged can upload
$successfulUpload = true; // flag - problems with uploading
$checkSuccessfulUpload = false; // flag - problems with moving uploaded file
$uploadFile = true; // flag - is this file allowed to be uploaded
$fileSize = true; // flag - is this file the allowed size
$emptyFile = false; // flag - is there any selected file

$validTitle = false; // flag - is the title valid
$uniqueTitle = true; // flag - are there any other posts with the same title
// Is 'Upload' Pressed:
if (isset ( $_POST ['submit'] )) {
	
	$fileTitle = trim(htmlentities($_POST['fileTitle']));
	
	// session_start ();
	// Has the session started:
	if (! isset ( $_SESSION ['username'] )) {
		$logged = false;
	} else {
		// Is there any file selected - don't trust this very much, it always gives isset:
		if (isset ( $_FILES ['fileUpload'] )) {
			$fileOnServerName = $_FILES ['fileUpload'] ['tmp_name'];
			$fileOriginalName = $_FILES ['fileUpload'] ['name'];
			$fileOriginalSize = $_FILES ['fileUpload'] ['size'];
			$fileType = $_FILES ['fileUpload'] ['type'];
			$category = trim ( htmlentities ( $_POST ['fileCategory'] ) );
			$imageFileType = pathinfo ( $fileOriginalName, PATHINFO_EXTENSION );
			// Is the title valid:
			if (mb_strlen($fileTitle,"UTF-8") > 2 && mb_strlen($fileTitle,"UTF-8") <= 30) {
				$validTitle = true;
			}
			// Does the title contain symbols that are not allowed:
			for ($t = 0; $t < mb_strlen($fileTitle,"UTF-8"); $t++) {
				if ($fileTitle{$t} == "#") {
					$validTitle = false;
				}
				if ($t > 0 && $fileTitle{$t} == " " && $fileTitle{$t-1} == " ") {
					$validTitle = false;
				}
			}
			// Is the title unique in the category folder of the user:
			if (file_exists ( './users/' . $_SESSION ['username'] . '/upload/' . $category . '/' . $fileTitle . '.' . $imageFileType)) {
				$uniqueTitle = false;
			}
			// Is the title unique for the whole format:
			if ($uniqueTitle) {
				if ($imageFileType == "mp4") {
					$filePath= "./users/videoteka.txt";
				} elseif ($imageFileType == "gif") {
					$filePath= "./users/gifoteka.txt";
				} else {
					$filePath= "./users/gallery.txt";
				}
				$currentGallery = file_get_contents($filePath);
				
				$currentGallery = explode(PHP_EOL,$currentGallery);
				array_pop($currentGallery);
				for($index = 0; $index < count($currentGallery); $index++) {
					$galleryArray = explode('#',$currentGallery[$index]);
					if ($galleryArray[3] == $imageFileType) {
						if ($galleryArray[1] == $fileTitle) {
							$uniqueTitle = false;
							break;
						}
					}
				}
			}
			// Is there any file selected:
			if (! empty ( $fileOnServerName )) {
				$imageCheck = getimagesize ( $fileOnServerName );
				if (function_exists ( 'mime_content_type' )) {
					$mimeType = mime_content_type ( $fileOnServerName );
					// First check for MIME type:
					if ($mimeType !== "image/jpeg" && $mimeType !== "image/png" && $mimeType !== "image/gif" && $mimeType !== "video/mp4" && $mimeType !== "image/bmp") {
						$uploadFile = false;
					}
					// Additional check for images:
					if ($mimeType == "image/jpeg" || $mimeType == "image/png" || $mimeType == "image/gif" || $mimeType == "image/bmp") {
						if ($imageCheck === false) {
							$uploadFile = false;
						}
					}
				}
				// Second check for MIME type - for extra security:
				if ($imageFileType != "jpg" && $imageFileType != "gif" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "mp4" && $imageFileType != "bmp") {
					$uploadFile = false;
					// echo $imageFileType;
				}
				if (! function_exists ( 'mime_content_type' )) {
					if ($imageFileType == "jpg" || $imageFileType == "gif" || $imageFileType == "jpeg" || $imageFileType == "png" || $imageFileType == "bmp") {
						if ($imageCheck === false) {
							$uploadFile = false;
						}
					}
					if ($fileType !== "image/jpeg" && $fileType !== "image/png" && $fileType !== "image/gif" && $fileType !== "video/mp4" && $fileType !== "image/bmp") {
						$uploadFile = false;
					}
				}
				if ($fileOriginalSize > 8000000) {
					$fileSize = false;
				}
			} else {
				$emptyFile = true;
			}
			if ($uploadFile && $fileSize && $validTitle && $uniqueTitle) {
				if (is_uploaded_file ( $fileOnServerName )) {
					
					if (! file_exists ( './users/' . $_SESSION ['username'] . '/upload/' . $category )) {
						mkdir ( './users/' . $_SESSION ['username'] . '/upload/' . $category );
					}
					$temporary = explode(".", $_FILES["fileUpload"]["name"]);
					$newfilename = $fileTitle . '.' . end($temporary);
					//move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);
					if (move_uploaded_file ( $fileOnServerName, './users/' . $_SESSION ['username'] . '/upload/' . $category . '/' . $newfilename )) {
						$checkSuccessfulUpload = true;
						try {
							// Create file for comments
							$commentsHandle = fopen ( './users/' . $_SESSION ['username'] . '/upload/' . $category . '/' . $fileTitle . 'Comments.txt','a+' );
						}
						catch (Exception $e) {
							throw new Exception ( "Something went wrong with the handle.", $e );
						}
						finally {
							fclose($commentsHandle);
						}
						try {
							// Add to gallery file the Uploader's username, the title, the entire filename, the extension(format),
							// and the beginning count of likes and dislikes:
							if ($imageFileType == "mp4") {
								$galleryHandle = fopen('users/videoteka.txt','a+');
							} elseif ($imageFileType == "gif") {
								$galleryHandle = fopen('users/gifoteka.txt','a+');
							} else {
								$galleryHandle = fopen('users/gallery.txt','a+');
							}
							
							fwrite($galleryHandle,$_SESSION ['username']);
							fwrite($galleryHandle,'#');
							fwrite($galleryHandle,$fileTitle);
							fwrite($galleryHandle,'#');
							fwrite($galleryHandle,$newfilename);
							fwrite($galleryHandle,'#');
							fwrite($galleryHandle,end($temporary));
							fwrite($galleryHandle,'#');
							fwrite($galleryHandle,$category);
							fwrite($galleryHandle,'#');
							fwrite($galleryHandle,'0');
							fwrite($galleryHandle,'#');
							fwrite($galleryHandle,'0');
							fwrite($galleryHandle,PHP_EOL);
						}
						catch (Exception $e) {
							throw new Exception ( "Something went wrong.", $e );
						}
						finally {
							fclose($galleryHandle);
						}
					} else {
						$successfulUpload = false;
					}
				} else {
					$successfulUpload = false;
				}
			}
		}
	}
} else {
	$fileTitle = "";
}


?>
<h2 id="titleUploadLink"><?php randSmileMsgGenerator (); ?> <img src="./assets/images/uploadForm/bigSmile2.png" alt="Big Smile" align="middle" /></h2>
<div id="uploadFormIntro">
	<p class="helloUpload">Hello, <?php if (isset ( $_SESSION ['username'] )) { echo $_SESSION ['username']; } else { echo "Dear Guest"; } ?>! If you enjoy posts like this one:</p>
	<div id="bearContainer"><img src="./assets/images/uploadForm/hiBear.gif" alt="Bear says 'Hi'" /></div>
	<p class="helloUpload">or this one:</p>
	<div id="birdsContainer"><img src="./assets/images/uploadForm/birds.jpg" alt="Anime with birds and boy" id="birds" /></div>
	<p class="helloUpload">Then you are at the right place!</p>
	<p class="helloUploadMessage">With our web page you can bring your passion for fun one step further! If you create funny posters(images, gifs, etc.) or you shoot funny clips, why don't you let all the world see them and laugh?! Use our form to upload a poster you have created or you find funny and make someone's day better!</p>

<?php
if (! isset ( $_SESSION ['username'] )) {
?>
	<p class="helloUploadMessage"><a href="?page=register">Register</a> or <a href="?page=login">Login</a> to gain access to our upload form.</p>
</div>
<?php 
} else {
?>
<div id="upload-form">
	<div class='fieldset'>
		<legend>Upload to Entertain us</legend>
		<form action="?page=upload" method="post" data-validate="parsley" enctype='multipart/form-data' onsubmit="return Validate(this);" >
			<div class='row'>
				<input type='hidden' name='MAX_FILE_SIZE' value='8000000' />
				<input type="text" id="fileName" class="file_input_textbox" readonly="readonly">
				<div class="file-drop-area">
					<span class="fake-btn">Choose file</span> <span
						class="file-msg js-set-number">or drag and drop file here</span>
					<input class="file-input" type="file"  name="fileUpload" onchange="javascript: document.getElementById('fileName').value = this.value" >
				</div>
				<br />
			</div>
			<p id="titleForFile">Add title:</p>
			<input type="text" name="fileTitle" value="<?php echo $fileTitle; ?>" id="fileTitle" >
			<p id="appendTitleWarning"></p>
			<div class='row'>
				<p id="categoryForFiles">Choose File Category:</p>
				<select name="fileCategory" id="fileCategory">
					<option value="balkan">Balkan Humour</option>
					<option value="engHum">English Humour</option>
					<option value="memes">Memes</option>
					<option value="awkward">Awkward</option>
					<option value="blackHum">Dark Humour</option>
				</select>
			</div>
			<input name="submit" type="submit" value="Upload" id="uploadSubmit" >
			<p id="appendFileSizeWarning"></p>
			<?php 
				if (isset ( $_POST ['submit'] ) && !$logged) {
					echo "<p id='warningUpload' >You must login in order to upload!</p>";
				}
				if ($successfulUpload && $checkSuccessfulUpload) {
					echo "<p id='succTalk' >Thank you for your contribution!</p>";
				}
				if (!$successfulUpload && !$emptyFile) {
					echo "<p id='warningUpload' >The file could not be uploaded!</p>";
				}
				if ($emptyFile) {
					echo "<p id='warningUpload' >You haven't selected anything for upload, or your file is bigger than 8MB!</p>";
				}
				if (!$uploadFile) {
					echo "<p id='warningUpload' >You can upload: jpeg, jpg, gif, png or mp4.</p>";
				}
				if (!$fileSize) {
					echo "<p id='warningUpload' >You are not allowed to upload a file more than 8 MB!</p>";
				}
				if (isset ( $_POST ['submit'] ) && !$validTitle && $logged) {
					echo "<p id='warningUpload' >Please, add a correct title to your post!</p>";
				}
				if (!$uniqueTitle) {
					echo "<p id='warningUpload' >We are sorry, the title you have chosen has been taken. Try another.</p>";
				}
			?>
		</form>
	</div>
</div>
<?php 
}
?>
<script type="text/javascript">
function placeholderIsSupported() {
	test = document.createElement('input');
	return ('placeholder' in test);
}

$(document).ready(function(){
	placeholderSupport = placeholderIsSupported() ? 'placeholder' : 'no-placeholder';
	$('html').addClass(placeholderSupport);
});
</script>
<script src="./assets/javascript/scriptUpload.js" ></script>