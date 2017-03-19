<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>List of users</title>
	<link rel="stylesheet" href="./assets/css/style.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<script src="./assets/js/script.js" ></script>
</head>
<body>
	<a href="./addUser.php"><input type="submit" value="Add"/> </a>
	<?php
		/* Attempt MySQL server connection. Assuming you are running MySQL
		server with default setting (user 'root' with no password) */
		$link = mysqli_connect("localhost", "root", "");
		 
		// Check connection
		if($link === false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		 
		// Attempt select query execution
		$sql = "SELECT * FROM users.people";
		if($result = mysqli_query($link, $sql)){
		    if(mysqli_num_rows($result) > 0){
		        echo "<table>";
		            echo "<tr>";
		            	echo "<th>Profile Pic</th>";
		                echo "<th>Name</th>";
		                echo "<th>e-mail</th>";
		                echo "<th>years</th>";
		                echo "<th>Relationship status</th>";
		                echo "<th>Delete from list</th>";
		            echo "</tr>";
		        while($row = mysqli_fetch_array($result)){
		        	$path = $row['path'];
		            echo "<tr class='". $row['id'] . "' >";
		                echo "<td>" . "<a href=\"contactUser.php?id=$row[id]\" >" . "<img src=" . $path	. " alt='Profile Pic' />" . "<a/>" . "</td>";
		                echo "<td>" . $row['name'] . "</td>";
		                echo "<td>" . $row['emaill'] . "</td>";
		                echo "<td>" . $row['years'] . "</td>";
		                echo "<td>" . $row['status'] . "</td>";
		                echo "<td>" . "<button name='". $row['path'] . "' . id='". $row['id'] . "'" . " class='delete' type='button' onclick='deleteUser(this.id)' >Remove</button>" . "</td>";
		            echo "</tr>";
		        }
		        echo "</table>";
		        // Free result set
		        mysqli_free_result($result);
		    } else{
		    	echo "<br />";
		    	echo "<br />";
		        echo "No records matching your query were found.";
		    }
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		 
		// Close connection
		mysqli_close($link);
	?>
	
</body>
</html>