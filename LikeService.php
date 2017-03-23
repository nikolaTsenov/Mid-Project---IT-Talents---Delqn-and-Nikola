<?php
if (isset ( $_POST ['tit'] ) && $_SERVER ['REQUEST_METHOD'] == 'POST') {
	
	$tit = trim(htmlentities($_POST ['tit']));
	
	$filename = "";
	
	for ($i = 5; $i < mb_strlen($tit,"UTF-8"); $i++) {
		$filename .= $tit{$i};
	}
	
	$file = file_get_contents($filename);

	
} else {
	header ( 'Location:index.php' );
}

?>