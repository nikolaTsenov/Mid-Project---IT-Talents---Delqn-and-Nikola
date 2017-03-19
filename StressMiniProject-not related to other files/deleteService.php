<?php
if (isset ( $_GET ['q'] )) {
	$link = mysqli_connect ( "localhost", "root", "" );
	
	// Check connection
	if ($link === false) {
		die ( "ERROR: Could not connect. " . mysqli_connect_error () );
	}
	$q = intval ( $_GET ['q'] );
	
	// delete picture
	$sql = "SELECT path FROM users.people WHERE id = '" . $q . "'";
	if ($result = mysqli_query ( $link, $sql )) {
		if (mysqli_num_rows ( $result ) > 0) {
			while ( $row = mysqli_fetch_array ( $result ) ) {
				unlink ( $row ['path'] );
			}
		}
	}
	
	$con = mysqli_connect ( "localhost", "root", "" );
	if (! $con) {
		die ( 'Could not connect: ' . mysqli_error ( $con ) );
	}
	
	mysqli_select_db ( $con, "users" );
	$sql = "DELETE FROM users.people WHERE id = '" . $q . "'";
	
	if (mysqli_query ( $con, $sql )) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . mysqli_error ( $con );
	}
	
	mysqli_close ( $con );
} else {
	header ( 'Location:index.php' );
}


?>