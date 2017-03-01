<?php
// proverka dali minava prez index.php ili direktno vuvejda register.php
$index = true;

include ('header.php');



if(isset($_GET['page'])) {

	$page = $_GET['page'];
	$file = $page . ".php";
	if (!file_exists("$file")) {
		$page = 'notfound';
	}
}else {
	$page = 'homepage';
	}
	echo "<div id=\"page\">";
	include ($page . '.php');
	echo "</div>";



include ('footer.php');
?>