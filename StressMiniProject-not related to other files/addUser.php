<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Add users</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<style>
		body {
			background-color: #efeeed;
			font-family: 'Open Sans', sans-serif;
			font-size: 0.9em;
		}
		input[type=submit] {
			width: 3em;
			height: 3em;
			font-size: 1em;
			background-color: Transparent;
		    background-repeat: no-repeat;
			cursor: pointer;
		    overflow: hidden;
		    outline: none;
		    border: 1px solid #e58134;
		    border-radius: 30%;
		    color: #e58134;
		}
		input[type=submit]:hover, input[type=submit]:active {
			font-weight: bold;
			width: 3.2em;
			height: 3.2em;
		}
		a {
			text-decoration: none;
			color: #4286f4;
			padding: 0.3em;
			border: 1px solid #4286f4;
			border-radius: 30%;
		}
		a:hover, a:active {
			padding: 0.5em;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td><label for="name">Enter your Name: </label></td>
				<td><input name = "name" id ="name" type="text" /></td>
			</tr>
			<tr>
				<td><label for="email">Enter your Email address: </label></td>
				<td><input name = "email" id="email" type="text" /></td>
			</tr>
			<tr>
				<td><label for="age">Enter your Age: </label></td>
				<td><input name= "age" id="age" type="text" /></td>
			</tr>
			<tr>
				<td><p>Relationship status</p></td>
				<td><select name ="relationshipStatus">
				  <option value="single">Single</option>
				  <option value="married">Married</option>
				</select></td>
			</tr>
			<tr>
				<td><label for="fileToUpload">Select image to upload: </label></td>
				<td><input name="fileToUpload" id="fileToUpload" type="file" /></td>
			</tr>
			<tr>
				<td><input name="submit" type="submit" value="Save" /></td>
			</tr>
		</table>
	</form>
	<br />
	<br />
	<a href="./index.php" id="backBut" >Go to main page</a>
</body>
</html>