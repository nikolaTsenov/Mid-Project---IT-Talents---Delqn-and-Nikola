<?php
if(!$index) {
	header('Location:index.php?page=register');
	die();
}
?>
<?php 
	if (isset($_GET['pg'])) {
		$pageNum = $_GET['pg'];
		$postNum = ($pageNum * 10) - 9; 
	} else {
		$pageNum = 1;
		$postNum = 1;
	}
?>

<div id="contentWrapper">

	<aside id="leftAside"></aside>

	<main id="mainContent">
		<div id="contentMenu">
			<h2 id="titleVideosLink"><?php randSmileMsgGenerator (); ?> <img src="./assets/images/uploadForm/bigSmile2.png" alt="Big Smile" align="middle" /></h2>
			<p id="showHideSelector" >Select the categories you want to see:</p>
			<form action="" id="watchForm1">
							<div class="rounded"><input type="checkbox" name="category" value="balkan" class="category" id="balkan" checked="checked" /><label for="balkan">Balkan Humour</label></div>
							<div class="rounded"><input type="checkbox" name="category" value="engHum" class="category" id="engHum" checked="checked" /><label for="engHum">English Humour</label></div>
							<div class="rounded"><input type="checkbox" name="category" value="memes" class="category" id="memes" checked="checked" /><label for="memes">Memes</label></div>
							<div class="rounded"><input type="checkbox" name="category" value="awkward" class="category" id="awkward" checked="checked" /><label for="awkward">Awkward</label></div>
							<div class="rounded"><input type="checkbox" name="category" value="blackHum" class="category" id="blackHum" checked="checked" /><label for="blackHum">Dark Humour</label></div>
			</form>
		</div>
		<!-- anchor needed for identifying the user in js: -->
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
		<!-- anchor needed for paging in js: -->
		<a id="anchor2" style="display: none;"><?php echo $postNum ?></a>
		
		<div id="result">

		</div>
		<?php 
			// get an array with every recorded mp4:
			$countAllMP4 = file("./users/videoteka.txt");
			// get the number of all mp4s:
			$neededCount = count($countAllMP4);
			// how many pages will be needed with 10 posts on page:
			$numberOfPages = ceil($neededCount/10);
		?>
		<ul class="paging" id="pages">
		<li class="pgCounter"><a href="?page=videos&pg=1">&lt;&lt;&lt;</a></li>
		<li class="pgCounter"><a href="?page=videos&pg=<?php if ($pageNum > 1) { echo --$pageNum; } else { echo $pageNum; } ?>">&lt;</a></li>
		<?php 
			// the paging loop:
			for ($count = 1; $count <= $neededCount; $count+=10) {
				if (($count + 9) > $neededCount) {
					echo "<li class='pgCounter'><a href='?page=videos&pg=" . ceil($count/10) . "'>" . $count . " - " . $neededCount . "</a></li>";
				} else {
					echo "<li class='pgCounter'><a href='?page=videos&pg=" . ceil($count/10) . "'>" . $count . " - " . ($count+9) . "</a></li>";
				}
			}
		?>
		<li class="pgCounter"><a href="?page=videos&pg=<?php if ($pageNum == $numberOfPages) { echo $pageNum; } else { echo ++$pageNum; } ?>" >&gt;</a></li>
		<li class="pgCounter"><a href="?page=videos&pg=<?php echo $numberOfPages; ?>">&gt;&gt;&gt;</a></li>
		</ul>
	</main>

	<aside id="rightAside"></aside>

</div>
<script src="./assets/javascript/videos.js" ></script>