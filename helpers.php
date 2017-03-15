<?php
function dumpAndDie () {
	echo '<pre>';
	array_map(function($x) { var_dump($x); }, func_get_args());
	echo '</pre>';
	die;
}

function setMessage($msg){
	$messages = $_SESSION['messages'];
	if(empty($messages)) {
		$messages = array();
	}
	$messages[] = $msg;
	$_SESSION['messages'] = $messages;
}

function getMessages() {
	$messages = $_SESSION['messages'];
	if(empty($messages)) {
		return array();
	}
	return $messages;
}


function clearMessages() {
	$_SESSION['messages'] = array();
}
function myErrorHandler($errNumber,$errMsg) {
	if ($errNumber == E_WARNING || $errNumber == E_NOTICE) {
		echo "<p id='warningNotice'>Sth went slightly out of the true path.</p>";
		echo "<p id='warningNotice'>Continue with script.</p>";
	}
	if ($errNumber == E_ERROR || $errNumber == E_RECOVERABLE_ERROR) {
		echo "<p id='fatalError'>Sth went terribly wrong.</p>";
		echo "<p id='fatalError'>We will have to close. Sorry for the inconvenience!</p>";
		fclose($handle);
		fclose($galleryHandle);
		die();
	}
}