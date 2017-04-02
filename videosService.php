<?php

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['type'])) {
		if ($_POST['type'] == "video") {
			$data = file_get_contents ( "./users/videoteka.txt" );
		} elseif ($_POST['type'] == "gif") {
			$data = file_get_contents ( "./users/gifoteka.txt" );
		} else {
			$data = file_get_contents ( "./users/gallery.txt" );
		}
		$postersArr = explode ( PHP_EOL, $data );
		array_pop ( $postersArr );
		for($index = 0; $index < count ( $postersArr ); $index ++) {
			$row = explode ( '#', $postersArr [$index] );
	
			$postersArr [$index] = array (
					'username' => $row [0],
					'title' => $row [1],
					'fileName' => $row [2],
					'fileExtension' => $row [3],
					'category' => $row [4],
					'likes' => $row [5],
					'dislikes' =>$row [6]
			);
		}
	
		echo json_encode($postersArr);
	
	}
}

?>