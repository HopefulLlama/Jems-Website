<?php 
	session_start();
	
	function died($error) {
		// your error code can go here
		closeConnDb();
		$_SESSION['imageReturnMessage']='<p class="text-danger">'.$error.'</p>';		
		echo $error;
		header('Location: ./../gallery.php?id='.$_POST['gallery-id']);
	}
	
	if(isset($_SESSION['currentUser'])){
		$id = $_POST['id'];
		
		if(isset($_POST['editTitle-'.$id])){
			$newTitle = $_POST['editTitle-'.$id];
			if ($newTitle > 50) {
				died("Title cannot be longer than 50 characters.");
			}
			$newTitle = htmlentities($newTitle, ENT_QUOTES);
		}
		if(isset($_POST['editClient-'.$id])){
			$newClient = $_POST['editClient-'.$id];
			if ($newClient > 50) {
				died("Client cannot be longer than 50 characters.");
			}
			$newClient = htmlentities($newClient, ENT_QUOTES);
		}		
		if(isset($_POST['editProduced-'.$id])){
			$newProduced = $_POST['editProduced-'.$id];
			if($newProduced > 255){
				died("Produced cannot be longer than 255 characters.");
			}  
			
			$newProduced = htmlentities($newProduced, ENT_QUOTES);
		}
		
		if($_FILES['editImage-'.$id]['size'] > 0){
			$file = $_FILES['editImage-'.$id];
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
		$query = "UPDATE image SET ";
		if(isset($newTitle)){
			$query = $query."title='".$newTitle."' ";
			$columns++;
		}
		if(isset($newClient)){
			if($columns>0){
				$query = $query.", ";
			}
			$query = $query."client='".$newClient."' ";
		}		
		if(isset($newProduced)){
			if($columns>0){
				$query = $query.", ";
			}
			$query = $query."produced='".$newProduced."' ";
		}
		if(isset($file)){
			if($columns>0){
				$query = $query.", ";
			}
			$query = $query."image='".$content."', image_type='".$fileType."' ";
		}
		$query = $query." WHERE id = ".$id;
		
		$result = mysqli_query($conn, $query);
		if (!$result){
			died("Edit failed. Please try again.");
		} else {
			$_SESSION['imageReturnMessage'] = '<p class="text-success">Edit successful.</p>';
			header('Location: ./../gallery.php?id='.$_POST['gallery-id']);
		}
		
	} else {
		header('Location: ./../gallery.php?id='.$_POST['gallery-id']);
	}
?>