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
								<div class="rounded"><input type="checkbox" name="category" value="balkan" class="category" id="balkan" checked="checked" /><label for="balkan">Balkan Humour</label></div><br/>
								<div class="rounded"><input type="checkbox" name="category" value="engHum" class="category" id="engHum" checked="checked" /><label for="engHum">English Humour</label></div><br/>
								<div class="rounded"><input type="checkbox" name="category" value="memes" class="category" id="memes" checked="checked" /><label for="memes">Memes</label></div><br/>
								<div class="rounded"><input type="checkbox" name="category" value="awkward" class="category" id="awkward" checked="checked" /><label for="awkward">Awkward</label></div><br/>
								<div class="rounded"><input type="checkbox" name="category" value="blackHum" class="category" id="blackHum" checked="checked" /><label for="blackHum">Dark Humour</label></div>
				</form>
		</div>
		<div id="result">

		</div>
	</main>

	<aside id="rightAside"></aside>

</div>
<script src="./assets/javascript/videos.js" ></script>