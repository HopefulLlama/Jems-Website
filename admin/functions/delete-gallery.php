<?php
	session_start();
	function died($error) {
		// your error code can go here
		closeConnDb();
		$_SESSION['galleryReturnMessage']='<p class="text-danger">'.$error.'</p>';
		header('Location: ./../gallery-menu.php');
		echo $error;
		die();
	}
	
	if(isset($_SESSION['currentUser'])){
		if(isset($_GET['id'])){
			require_once './../../db-handler.php';
			
			$query = "DELETE FROM gallery WHERE id = ".$_GET['id'];
			
			mysqli_query($conn, $query);
			
			if(mysqli_affected_rows($conn)>0){
				$_SESSION['galleryReturnMessage']='<p class="text-success">Gallery deleted.</p>';
				header('Location: ./../gallery-menu.php');
			} else {
				died('Error deleting gallery. Please try again.');
			}
		}	
	}
?>