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
		if (isset($_POST['submitAddImage'])){
			if( isset($_POST['inputTitle']) && isset($_POST['inputClient']) && isset($_POST['inputProduced']) && $_FILES['inputImage']['size'] > 0){
				if($_POST['inputTitle'] > 50){
					died("Title cannot be longer than 50 characters.");
				}
				if($_POST['inputClient'] > 50){
					died("Client cannot be longer than 50 characters.");
				}
				if($_POST['inputProduced'] > 255){
					died("Produced for field cannot be longer than 255 characters.");
				}
				
				$fileName = $_FILES['inputImage']['name'];
				$tmpName  = $_FILES['inputImage']['tmp_name'];
				$fileSize = $_FILES['inputImage']['size'];
				$fileType = $_FILES['inputImage']['type'];
		
				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);
		
				if(!get_magic_quotes_gpc()){
					$fileName = addslashes($fileName);
				}
				
				$title = htmlentities($_POST['inputTitle'], ENT_QUOTES);
				$client = htmlentities($_POST['inputClient'], ENT_QUOTES);
				$produced = htmlentities($_POST['inputProduced'], ENT_QUOTES);
				
				require_once './../../db-handler.php';
				
				$query = "INSERT INTO image (gallery_id, title, client, produced, image, image_type) VALUES ('".$_POST['gallery-id']."', '".$title."', '".$client."', '".$produced."', '".$content."', '".$fileType."');";
				
				$result = mysqli_query($conn, $query);
				if (!$result){
					// died("Upload failed. Please try again.");
					died($query);
				} else {
					$_SESSION['imageReturnMessage'] = '<p class="text-success">Upload successful.</p>';
					header('Location: ./../gallery.php?id='.$_POST['gallery-id']);
				}
			} else {
				died("All fields must be completed.");
			}
		}
	} else {
		header('Location: ./../gallery.php?id='.$_POST['gallery-id']);
	}
	
?>