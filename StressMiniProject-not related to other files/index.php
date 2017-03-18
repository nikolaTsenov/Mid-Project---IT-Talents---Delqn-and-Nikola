<?php 

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>List of users</title>
	<link rel="stylesheet" href="./assets/css/style.css" type="text/css" />
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
		            echo "<tr>";
		                echo "<td>" . "<img src=" . $row['path'] . " alt='Profile Pic' />" . "</td>";
		                echo "<td>" . $row['name'] . "</td>";
		                echo "<td>" . $row['emaill'] . "</td>";
		                echo "<td>" . $row['years'] . "</td>";
		                echo "<td>" . $row['status'] . "</td>";
		                echo "<td>" . "<button id='delete' >Remove</button>" . "</td>";
		            echo "</tr>";
		        }
		        echo "</table>";
		        // Free result set
		        mysqli_free_result($result);
		    } else{
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