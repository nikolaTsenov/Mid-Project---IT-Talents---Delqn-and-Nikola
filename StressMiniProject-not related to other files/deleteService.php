<?php
$q = intval($_GET['q']);

$con = mysqli_connect("localhost", "root", "");
if (!$con) {
	die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"myDB");
$sql="DELETE FROM users.people WHERE id = '".$q."'";

if (mysqli_query($con, $sql)) {
	echo "Record deleted successfully";
} else {
	echo "Error deleting record: " . mysqli_error($con);
}

mysqli_close($con);
?>