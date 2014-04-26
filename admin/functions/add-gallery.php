<?php
	session_start();

	function died($error) {
		// your error code can go here
		closeConnDb();
		$_SESSION['galleryReturnMessage']='<p class="text-danger">'.$error.'</p>';
		echo $error;
		header('Location: ./../gallery-menu.php');
	}
	
	if(isset($_SESSION['currentUser'])){
		if (isset($_POST['submitAddGallery'])){
			if( isset($_POST['inputName']) && isset($_POST['inputDescription']) && $_FILES['inputThumbnail']['size'] > 0){
				if($_POST['inputName'] > 50){
					died("Name cannot be longer than 50 characters.");
				}
				if($_POST['inputDescription'] > 255){
					died("Description cannot be longer than 255 characters.");
				}
				
				$fileName = $_FILES['inputThumbnail']['name'];
				$tmpName  = $_FILES['inputThumbnail']['tmp_name'];
				$fileSize = $_FILES['inputThumbnail']['size'];
				$fileType = $_FILES['inputThumbnail']['type'];
		
				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);
		
				if(!get_magic_quotes_gpc()){
					$fileName = addslashes($fileName);
				}
				
				$name = htmlentities($_POST['inputName'], ENT_QUOTES);
				$description = htmlentities($_POST['inputDescription'], ENT_QUOTES);
				
				require_once './../../db-handler.php';
				
				$query = "INSERT INTO gallery (name, description, thumbnail, image_type) VALUES ('".$name."', '".$description."',  '".$content."', '".$fileType."');";
				
				$result = mysqli_query($conn, $query);
				if (!$result){
					died("Upload failed. Please try again.");
				} else {
					$_SESSION['galleryReturnMessage'] = '<p class="text-success">Upload successful.</p>';
					header('Location: ./../gallery-menu.php');
				}
			} else {
				died("All fields must be completed.");
			}
		}
	} else {
		header('Location: ./../gallery-menu.php');
	}
	
?>