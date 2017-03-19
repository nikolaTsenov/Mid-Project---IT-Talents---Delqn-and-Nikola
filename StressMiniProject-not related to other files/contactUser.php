<?php 
if(isset($_GET['id'])) {
	$id = $_GET['id'];
	/* Attempt MySQL server connection. Assuming you are running MySQL
	 server with default setting (user 'root' with no password) */
	$link = mysqli_connect("localhost", "root", "");
	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
		
	// Attempt select query execution
	$sql = "SELECT * FROM users.people WHERE id = $id ";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$path = $row['path'];
				$name = $row['name'];
				$email = $row['emaill'];
				$years = $row['years'];
				$status = $row['status'];
			}
			// Free result set
			mysqli_free_result($result);
		} else{
			header('Location:index.php');
			die();
		}
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
		
	// Close connection
	mysqli_close($link);
}else {
	header('Location:index.php');
	die();
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Contact form</title>
	<link rel="stylesheet" href="assets/css/profileStyle.css" />
</head>
<body>
	<div id = "wrapper">
		<table>
		<div id="imgDiv">
			<img id="profilePicture" src="<?=$path; ?>" alt="ProfilePicture" />
		</div>
			<tr>
				<th>Name: </th>
				<td><?=$name; ?> </td>
			</tr>
			<tr>
				<th>Years:</th>
				<td> <?=$years; ?> </td>
			</tr>
			<tr>
				<th>Email: </th>
				<td> <?=$email; ?> </td>
			</tr>
			<tr>
				<th>Relationship <br/> status: </th>
				<td><?=$status; ?> </td>
			</tr>
		</table>
		<form action="./email.php" method="post">
			<label for="emailFrom" >From: </label>
			<input name ="emailFrom" id="emailFrom" type="text" placeholder="email@example.com" maxlength="100"/>
			
			<label for="subject" >Subject: </label>
			<input id="subject" name = "subject" type="text" placeholder="Enter Your Subject" maxlength="50"/>
			
			<input name ="emailTo" type="hidden" value="<?= $email; ?>" />
			<div id = "textArea">
				<textarea name="message" id="email" cols="75" rows="7" maxlength="1000" placeholder="Enter your message"></textarea>
			</div>
			<input name="submit" type="submit" value="Send email" />
		</form>
	</div>
</body>
</html>