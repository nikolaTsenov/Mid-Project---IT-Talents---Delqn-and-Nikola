<?php
if(!$index) {
	header('Location:index.php?page=register');
	die();
}
?>


<div id="contentWrapper">

	<aside id="leftAside"></aside>

	<main id="mainContent">
		<div id="contentMenu">
			<legend>Select the categories you want to see:</legend>
				<form action="" id="watchForm1">
								<div class="rounded"><input type="checkbox" name="category" value="balkan" id="balkan" /><label for="Action">Balkan Humour</label></div><br/>
								<div class="rounded"><input type="checkbox" name="category" value="engHum" id="engHum" /><label for="Adventure">English Humour</label></div><br/>
								<div class="rounded"><input type="checkbox" name="category" value="memes" id="memes" /><label for="Animation">Memes</label></div><br/>
								<div class="rounded"><input type="checkbox" name="category" value="awkward" id="awkward" /><label for="Biography">Awkward</label></div><br/>
								<div class="rounded"><input type="checkbox" name="category" value="blackHum" id="blackHum" /><label for="Documentary">Dark Humour</label></div>
				</form>
		</div>
			<button id="but">bn</button>
		<div id="result">
<!--  <div class="poster">
			<h4 class="posterTitle"></h4>
			<div class="posterContainer">
				<img src="" alt="" />
			</div>
			<div class="posterReactions">
				<div class="like">
					<a href=""><img src="" alt="" /></a>
				</div>
				<div class="dislike">
					<a href=""><img src="" alt="" /></a>
				</div>
			</div>
			<div class="comments"></div> 
		</div> -->
		</div>
	</main>

	<aside id="rightAside"></aside>

</div>
<script src="./assets/javascript/videos.js" ></script>