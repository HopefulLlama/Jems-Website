<?php
	session_start();
	function died($error) {
		// your error code can go here
		closeConnDb();
		$_SESSION['imageReturnMessage']='<p class="text-danger">'.$error.'</p>';
		header('Location: ./../gallery.php?id='.$_GET['galleryId']);
		echo $error;
		die();
	}
	
	if(isset($_SESSION['currentUser'])){
		if(isset($_GET['id'])){
			require_once './../../db-handler.php';
			
			$query = "DELETE FROM image WHERE id = ".$_GET['id'];
			
			mysqli_query($conn, $query);
			
			if(mysqli_affected_rows($conn)>0){
				$_SESSION['imageReturnMessage']='<p class="text-success">Image deleted.</p>';
				header('Location: ./../gallery.php?id='.$_GET['galleryId']);
			} else {
				died('Error deleting gallery. Please try again.');
			}
		}	
	}
?>