<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Add users</title>
</head>
<body>
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<label for="name">Enter your Name: </label>
		<input name = "name" id ="name" type="text" />
		
		<label for="email">Enter your Email address: </label>
		<input name = "email" id="email" type="text" />
		
		<label for="age">Enter your Age: </label>
		<input name= "age" id="age" type="text" />
		
		<p>Relationship status</p>
		<select name ="relationshipStatus">
		  <option value="single">Single</option>
		  <option value="married">Married</option>
		</select>
		
		<label for="fileToUpload">Select image to upload: </label>
		<input name="fileToUpload" id="fileToUpload" type="file" />
		<input name="submit" type="submit" value="Save" />
	</form>
</body>
</html>