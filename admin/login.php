<?php
	require_once 'header.php';
	
	if(isset($_SESSION['currentUser'])){
		header('Location: ./gallery-menu.php');
	}	

	if(isset($_POST['submitLogin'])) {
		if(isset($_POST['inputUsername']) && isset($_POST['inputPassword'])){
			require_once './../db-handler.php';
			$query = "SELECT * FROM user WHERE username='".$_POST['inputUsername']."' AND password=PASSWORD('".$_POST['inputPassword']."');";
			openConnDb();
			
			$results = mysqli_query($conn, $query);
			if($results->num_rows==1){
				while($obj = mysqli_fetch_object($results)) {
					printf($obj->username);
					$_SESSION['currentUser']=$obj->username;
					
					if(isset($_POST['remember'])){
						// Set a cookie to remember the username.
						setcookie("username", $obj->username, time()+60*60*24*30);
					} else {
						setcookie("username", "", time()-10);
					}
					
					header('Location: ./gallery-menu.php');
				}
			} else {
				$_SESSION['loginError']="Error logging in. Incorrect Username/Password combination.";
			}
		} else {
			$_SESSION['loginError']="Username and Password must both be completed.";
		}
	}
?>

<div class="container">
	<?php
		if(isset($_SESSION['loginError'])){
			?><div class="col-xs-10 col-xs-offset-2"><p class="text-danger"><?php echo $_SESSION['loginError']; unset($_SESSION['loginError']); ?></p></div>
	<?php	
		} 
	?>
	<form class="form-horizontal" role="form" method="post" action="login.php">
  		<div class="form-group">
    		<label for="inputUsername" class="col-sm-2 control-label">Username</label>
    		<div class="col-sm-10">
      			<input name="inputUsername" type="text" class="form-control" id="inputUsername" placeholder="Username" value="<?php 
					if(isset($_POST['inputUsername'])){
						echo $_POST['inputUsername'];
					} else if (isset($_COOKIE['username'])){ 
						echo $_COOKIE['username'];
					}
				?>">
    		</div>
  		</div>
  		<div class="form-group">
    		<label for="inputPassword" class="col-sm-2 control-label">Password</label>
		    <div class="col-sm-10">
			      <input name="inputPassword" type="password" class="form-control" id="inputPassword" placeholder="Password">
			    </div>
		  	</div>
	  	<div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
				<div class="checkbox">
		        	<label>
		          		<input name="remember" type="checkbox" <?php
		          			if (isset($_COOKIE['username'])){ 
								echo "checked";
							}
						?>> Remember me
		        	</label>
		      	</div>
	    	</div>
	  	</div>
	  	<div class="form-group">
	    	<div class="col-sm-offset-2 col-sm-10">
	      		<button name="submitLogin" type="submit" class="btn btn-default">Log in</button>
		    </div>
	  	</div>
	</form>
</div>

<?php
	require_once 'footer.php';
?>