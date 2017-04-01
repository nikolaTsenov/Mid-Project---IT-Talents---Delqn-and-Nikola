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
			<h2 id="titleVideosLink">Meet every day with a big smile! <img src="./assets/images/uploadForm/bigSmile2.png" alt="Big Smile" align="middle" /></h2>
			<p id="showHideSelector" >Select the categories you want to see:</p>
			<form action="" id="watchForm1">
							<div class="rounded"><input type="checkbox" name="category" value="balkan" class="category" id="balkan" checked="checked" /><label for="balkan">Balkan Humour</label></div>
							<div class="rounded"><input type="checkbox" name="category" value="engHum" class="category" id="engHum" checked="checked" /><label for="engHum">English Humour</label></div>
							<div class="rounded"><input type="checkbox" name="category" value="memes" class="category" id="memes" checked="checked" /><label for="memes">Memes</label></div>
							<div class="rounded"><input type="checkbox" name="category" value="awkward" class="category" id="awkward" checked="checked" /><label for="awkward">Awkward</label></div>
							<div class="rounded"><input type="checkbox" name="category" value="blackHum" class="category" id="blackHum" checked="checked" /><label for="blackHum">Dark Humour</label></div>
			</form>
		</div>
		<?php 
			if (isset ( $_SESSION ['username'] )) {
		?>
			<a id="anchor" style="display: none;"><?php echo $_SESSION ['username']; ?></a>
		<?php
			} else {
		?>
			<a id="anchor" style="display: none;">Anchor</a>
		<?php 
			}
		?>
		<div id="result">

		</div>
		
	</main>

	<aside id="rightAside"></aside>

</div>
<script src="./assets/javascript/videos.js" ></script>