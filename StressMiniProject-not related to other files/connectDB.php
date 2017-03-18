<?php
$host='localhost';
$user='root';
$password='';
$db='hr';


$connection =  mysqli_connect($host,$user,$password,$db);

$result = mysqli_query($connection,
		"SELECT first_name FROM hr.employees");
$result = mysql_fetch_array($connection);
var_dump($result);
?>