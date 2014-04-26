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
		$id = $_POST['id'];
		
		if(isset($_POST['editName-'.$id])){
			$newName = $_POST['editName-'.$id];
			if ($newName > 50) {
				died("Name cannot be longer than 50 characters.");
			}
			$newName = htmlentities($newName, ENT_QUOTES);
		}
		
		if(isset($_POST['editDescription-'.$id])){
			$newDesc = $_POST['editDescription-'.$id];
			if($newDesc > 255){
				died("Description cannot be longer than 255 characters.");
			}  
			
			$newDesc = htmlentities($newDesc, ENT_QUOTES);
		}
		
		if($_FILES['editThumbnail-'.$id]['size'] > 0){
			$file = $_FILES['editThumbnail-'.$id];
			$fileName = $file['name'];
			$tmpName  = $file['tmp_name'];
			$fileSize = $file['size'];
			$fileType = $file['type'];
		
			$fp      = fopen($tmpName, 'r');
			$content = fread($fp, filesize($tmpName));
			$content = addslashes($content);
			fclose($fp);
	
			if(!get_magic_quotes_gpc()){
				$fileName = addslashes($fileName);
			}
		}
		
		require_once './../../db-handler.php';
		$columns = 0;
		$query = "UPDATE gallery SET ";
		if(isset($newName)){
			$query = $query."name='".$newName."' ";
			$columns++;
		}
		if(isset($newDesc)){
			if($columns>0){
				$query = $query.", ";
			}
			$query = $query."description='".$newDesc."' ";
		}
		if(isset($file)){
			if($columns>0){
				$query = $query.", ";
			}
			$query = $query."thumbnail='".$content."', image_type='".$fileType."' ";
		}
		$query = $query." WHERE id = ".$id;
		
		$result = mysqli_query($conn, $query);
		if (!$result){
			died("Edit failed. Please try again.");
		} else {
			$_SESSION['galleryReturnMessage'] = '<p class="text-success">Edit successful.</p>';
			header('Location: ./../gallery-menu.php');
		}
		
	} else {
		header('Location: ./../gallery-menu.php');
	}
?>