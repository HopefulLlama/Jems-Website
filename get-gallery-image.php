<?php
/*
Adapted http://stackoverflow.com/questions/7793009/how-to-retrieve-images-from-mysql-database-and-display-in-an-html-tag accessed 22/10/2013
*/
	require 'db-handler.php';
	
	openConnDB();
	$query = "SELECT thumbnail, image_type FROM gallery WHERE id=".$_GET['id'];
	$result = mysqli_query($conn, $query);
	
	if($result){
		while ($obj = mysqli_fetch_object($result)) {
			header("Content-Type: ".$obj->image_type);
			echo $obj->thumbnail;
		}
	} else {
		echo "error";
	}
?>

