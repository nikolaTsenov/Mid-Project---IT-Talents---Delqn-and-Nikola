<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="description" content="7cheers"/>
<meta http-equiv="author" name="Nikola Tsenov, Delqn Kolev" />
<title>7cheers</title>
<link rel="stylesheet" href="./assets/css/reset.css" type="text/css" />
<link rel="stylesheet" href="./assets/font-awesome-4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="./assets/css/gornaLenta.css" type="text/css" />
<link rel="stylesheet" href="./assets/css/register.css" type="text/css" />
</head>
<body>
	<div id="wrapper">
		<header id="header">
				<div class="dropdown">
					<!-- The inside of the button is unclickable, tried many tags, nothing worked. I liked my animation, so I just couldn't erase it...-->
					<button onclick="dropdownFunction()" class="dropbtn"><!--  <p id="doIT">-->&#9776;<!-- &nbsp;<i class="fa fa-arrow-left" aria-hidden="true"></i></p>--></button>
					<h2><a href="">Home </a></h2>
  					<div id="myDropdown" class="dropdown-content">
   						<a href="#mostPopular">VIDEOS</a>
   						<a href="#mostPopular">IMAGES</a>
   						<a href="#news">GIFS</a>
   						<a href="#contact">NEWS</a>
   						<a href="?page=register">Register</a>
   						<a href="?page=login">Login</a>
   						<a href="#contact">CONTACTS</a>
  					</div>
				</div>
				<form id="searchingForm">
  					<input type="text" name="search" placeholder="Search..">
				</form>
				<h1 id="heading"><a href="?page=homepage"><img src="./assets/images/logo7.png" alt="logo7" />cheers</a></h1>
				<ul id="topperNav">
					<li id="videos"><a href="">VIDEOS</a></li>
					<li id="images"><a href="">IMAGES</a></li>
					<li id="gifs"><a href="">GIFS</a></li>
					<li class="news"><a href="">NEWS</a>
						<div class="dropboxHover">
							<a href="">Link 1</a>
							<a href="">Link 2</a>
							<a href="">Link 3</a>
						</div>
					</li>
					<li id="register"><a href="?page=register">Register</a></li>
					<li id="login"><a href="?page=login">Login</a></li>
					<li id="contacts"><a href="">CONTACTS</a></li>
					<li id="search"><a href=""><i class="fa fa-search"></i></a></li>
				</ul>
				<form id="searchingForm2">
  					<input type="text" name="search" placeholder="Search..">
				</form>
			</header>	
	</div>	
	<script type="text/javascript">
			/* When the user clicks on the button, 
			toggle between hiding and showing the dropdown content */
			function dropdownFunction() {
   				document.getElementById("myDropdown").classList.toggle("show");
			}

			// Close the dropdown if the user clicks outside of it
			window.onclick = function(event) {
  			if (!event.target.matches('.dropbtn')) {

    		var dropdowns = document.getElementsByClassName("dropdown-content");
    		var i;
   			for (i = 0; i < dropdowns.length; i++) {
      		var openDropdown = dropdowns[i];
     		if (openDropdown.classList.contains('show')) {
        	openDropdown.classList.remove('show');
      					}
    				}
  				}
			}
	</script>	
