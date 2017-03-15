<?php
session_start();
include ('helpers.php');
set_error_handler('myErrorHandler');
$index = true;
if(isset($_GET['page'])) {

	$page = $_GET['page'];
	$file = $page . ".php";
	if (!file_exists("$file")) {
		$page = 'notfound';
	}
}else {
	$page = 'homepage';
}


ob_start();
include ($page . '.php');
$content = ob_get_contents();
ob_end_clean();



include ('header.php');
echo $content;
include ('footer.php');
clearMessages();
?>