<?php
	/*
		http://stackoverflow.com/questions/6249707/check-if-php-session-has-already-started [Accessed 25 November 2013]
	*/
	if (session_id() == '') {
		session_start();
	}
?>
<head>
	<title>Admin</title>
	<meta name="Author" content="Jonathan Law" />
	<meta name="Keywords" content="Jonathan Law, Admin"/>
	<meta name="Description" content="Example." />
	
	<link rel="stylesheet" type="text/css" href="/lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/lib/bootstrap/css/bootstrap-theme.min.css">
	
	<link rel="stylesheet" type="text/css" href="./stylesheet.css">
	
	<link rel="shortcut icon" href="/images/favicon.png"/>
	
	<script src="/lib/jquery/jquery-1.11.0.min.js"></script>
	<script src="/lib/bootstrap/js/bootstrap.min.js"></script>
	
	<script src="./toggle-panel.js"></script>
	<script src="./delete-gallery-button.js"></script>
	<script src="./delete-image-button.js"></script>
	<script src="./main.js"></script>
</head>
<body>	
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		   	  <?php
		      	if(isset($_SESSION['currentUser'])){
      		  ?>
      		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
		          <span class="sr-only">Toggle navigation</span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </button>
		      <?php
		        }
		      ?>
		      
		      <?php
		      	if(isset($_SESSION['currentUser'])){
      		  ?><a class="navbar-brand" href="./gallery-menu.php"><?php echo 'admin/'.$_SESSION['currentUser'] ?></a><?php
		      	} else {
		      ?><a class="navbar-brand">admin</a><?php
		      	}
		      ?>
		    </div>
			
			<?php
		      	if(isset($_SESSION['currentUser'])){
      		?>
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="navbar-collapse">
		      <ul class="nav navbar-nav navbar-right" role="banner">
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
		          <ul class="dropdown-menu">
		          	<li><a href="#">Change Password</a></li>
       	            <li class="divider"></li>
		            <li><a href="logout.php">Log out</a></li>
		          </ul>
		        </li>
		        <li><a href="./gallery-menu.php">Galleries</a></li>  
		      </ul>
		    </div><!-- /.navbar-collapse -->
		    <?php
				}
			?>
		  </div><!-- /.container-fluid -->
		</div>
	</nav>
