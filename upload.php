<?php
// da ne moje da se otvori linka direktno
if(!$index) {
	header('Location:/9gag/?page=upload');
	die();
}

$logged = true; //flag - no one not logged can upload
$successfulUpload = true; // flag - problems with uploading
$checkSuccessfulUpload = false; // flag - problems with moving uploaded file
$uploadFile = true; // flag - is this file allowed to be uploaded
$fileSize = true; // flag - is this file the allowed size
$emptyFile = false; // flag - is there any selected file
// Is 'Upload' Pressed:
if (isset ( $_POST ['submit'] )) {
	//session_start ();
	// Has the session started:
	if (! isset ( $_SESSION ['username'] )) {
		$logged = false;
	} else {
		// Is there any file selected - don't trust this very much, it always gives isset:
		if (isset ( $_FILES ['fileUpload'] )) {
			$fileOnServerName = $_FILES ['fileUpload'] ['tmp_name'];
			$fileOriginalName = $_FILES ['fileUpload'] ['name'];
			$fileOriginalSize = $_FILES ['fileUpload'] ['size'];
			$category = trim ( htmlentities ( $_POST ['fileCategory'] ) );
			$imageFileType = pathinfo($fileOriginalName,PATHINFO_EXTENSION);
			// Is there any file selected:
			if (! empty ( $fileOnServerName )) {
				$mimeType = mime_content_type ( $fileOnServerName );
				$imageCheck = getimagesize($fileOnServerName);
				// First check for MIME type:
				if ($mimeType !== "image/jpeg" && $mimeType !== "image/png" && $mimeType !== "image/gif" && $mimeType !== "video/mp4") {
					$uploadFile = false;
				}
				// Additional check for images:
				if ($mimeType == "image/jpeg" || $mimeType == "image/png" || $mimeType == "image/gif") {
					if ($imageCheck === false) {
						$uploadFile = false;
					}
				}
				// Second check for MIME type - for extra security:
				if ($imageFileType != "jpg" && $imageFileType != "gif" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "mp4") {
					$uploadFile = false;
					//echo $imageFileType;
				}
				if ($fileOriginalSize > 8000000) {
					$fileSize = false;
				}
			} else {
				$emptyFile = true;
			}
			if ($uploadFile && $fileSize) {
				if (is_uploaded_file ( $fileOnServerName )) {
					
					if (! file_exists ( './users/' . $_SESSION ['username'] . '/upload/' . $category )) {
						mkdir ( './users/' . $_SESSION ['username'] . '/upload/' . $category );
					}
					if (move_uploaded_file ( $fileOnServerName, './users/' . $_SESSION ['username'] . '/upload/' . $category . '/' . $fileOriginalName )) {
						$checkSuccessfulUpload = true;
					} else {
						$successfulUpload = false;
					}
				} else {
					$successfulUpload = false;
				}
			}
		}
	}
}


?>
<div id="registration-form">
	<div class='fieldset'>
		<legend>Upload to Entertain us</legend>
		<form action="?page=upload" method="post" data-validate="parsley" enctype='multipart/form-data'>
			<div class='row'>
				<input type='hidden' name='MAX_FILE_SIZE' value='8000000' />
				<input type="text" id="fileName" class="file_input_textbox" readonly="readonly">
				<p class="file">
					<input type="file" name="fileUpload" id="file" onchange="javascript: document.getElementById('fileName').value = this.value" /> 
					<label for="file">Choose file</label>
				</p>
				<br />
			</div>
			<div class='row'>
				<label for="fileCategory">Choose category:</label> 
				<select name="fileCategory" id="fileCategory">
					<option value="balkan">Balkan Humour</option>
					<option value="engHum">English Humour</option>
					<option value="memes">Memes</option>
					<option value="awkward">Awkward</option>
					<option value="blackHum">Dark Humour</option>
				</select>
			</div>
			<input name="submit" type="submit" value="Upload">
			<?php 
				if (isset ( $_POST ['submit'] ) && !$logged) {
					echo "<p id='warningUpload' >You must register in order to upload!</p>";
				}
				if ($successfulUpload && $checkSuccessfulUpload) {
					echo "<p id='succTalk' >Thank you for your contribution!</p>";
				}
				if (!$successfulUpload && !$emptyFile) {
					echo "<p id='warningUpload' >The file could not be uploaded!</p>";
				}
				if ($emptyFile) {
					echo "<p id='warningUpload' >You haven't selected anything for upload!</p>";
				}
				if (!$uploadFile) {
					echo "<p id='warningUpload' >You can upload: jpeg, jpg, gif, png or mp4.</p>";
				}
				if (!$fileSize) {
					echo "<p id='warningUpload' >You are not allowed to upload a file more than 8 MB!</p>";
				}
			?>
		</form>
	</div>
</div>
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