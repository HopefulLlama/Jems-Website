<head>
	<title>Jem Soar</title>
	<meta name="Author" content="Jonathan Law" />
	<meta name="Keywords" content="Jonathan Law, Example"/>
	<meta name="Description" content="Example." />
	
	<link rel="stylesheet" type="text/css" href="/lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/lib/bootstrap/css/bootstrap-theme.min.css">
	
	<link rel="stylesheet" type="text/css" href="./stylesheet.css">
	
	<link rel="shortcut icon" href="/images/favicon.png"/>
	
	<script src="/lib/jquery/jquery-1.11.0.min.js"></script>
	<script src="/lib/bootstrap/js/bootstrap.min.js"></script>
	
	<script src="gallery.js"></script>
	<script src="main.js"></script>
</head>

<?php
	require_once 'class_gallery.php';
	$galleries = array();
	
	// Get all galleries as required to populate the nav-menu 
	// then store in an array if for later convenience.

	require_once './db-handler.php';
	$query = "SELECT id, name, description FROM gallery;";
	openConnDb();
	
	$results = mysqli_query($conn, $query);
	if($results->num_rows>0){
		while($obj = mysqli_fetch_object($results)) {
			array_push($galleries, new Gallery($obj->id, $obj->name, $obj->description));			
		}
	}
?>		
<body>
    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="contactModalLabel">Contact Details</h4>
                </div>
                <div class="modal-body">
                	<p>Please feel free to contact me using any of the listed methods. My contact hours are between 5pm - 7pm.</p>
                	<div class="table-responsive">
                    	<table class="table table-hover table-condensed">
                    		<tr><td><b>E-mail: </b></td><td><a href"mailto:example@example.com">example@example.com</a></td></tr>
                    		<tr><td><b>Telephone: </b></td><td>XXX XXXX XXXX</td></tr>
                    		<tr><td><b>Mobile: </b></td><td>XXX XXXX XXXX</td></tr>
                    		<tr><td><b>Address: </b></td><td>XX Example Road, <br />Exemplary, <br /> Exem, </br/> EX48 7LE</td></tr>
                    	</table>
                	</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
     <!-- Small Print Modal -->
    <div class="modal fade" id="smallPrintModal" tabindex="-1" role="dialog" aria-labelledby="smallPrintModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="smallPrintModalLabel">Small Print</h4>
                </div>
                <div class="modal-body">
                	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae est hendrerit, vehicula velit non, pulvinar massa. Phasellus scelerisque eget lectus sed ultrices. Aliquam nulla augue, ullamcorper eu eleifend quis, adipiscing vitae nisl. Sed eu turpis consectetur dui volutpat semper at eget tortor. Etiam tincidunt gravida lorem, et tincidunt metus. Mauris tristique malesuada elit, id interdum lectus pretium non. Vivamus mi risus, pulvinar at ligula vitae, dictum elementum felis. Etiam tellus purus, rhoncus ac enim sed, ultrices malesuada risus. Nam lacinia hendrerit ligula varius pretium. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas scelerisque enim arcu, eget volutpat magna adipiscing eu. Vivamus non laoreet erat.</p>
					<p>Pellentesque nec hendrerit neque. Cras rutrum ac sem vel mattis. Maecenas in tempor nulla. Nunc nec accumsan ante. Integer nec sem eleifend, tempor nulla non, ornare neque. Nullam fermentum sagittis dolor, nec cursus orci feugiat quis. Nulla facilisi. Nunc dictum, velit viverra suscipit cursus, ipsum urna pharetra orci, a hendrerit justo ante sit amet urna. Nullam rutrum lectus id nisi vulputate, non condimentum mauris pharetra. Nullam feugiat et sem consequat scelerisque. Donec placerat volutpat consectetur. Donec in mi mattis, laoreet neque et, dignissim lacus.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
	<!-- Links Modal -->
    <div class="modal fade" id="linksModal" tabindex="-1" role="dialog" aria-labelledby="linksModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="linksModalLabel">Links</h4>
                </div>
                <div class="modal-body">
                	<p><b><a href="http://hopefulllama.dnsd.me/">HopefulLlama</a></b> - Designer of this web site.</p>
                    <p><b><a href="http://jquery.com/">jQuery</a></b> - Feature rich library to each the usage of JavaScript.</p>
                    <p><b><a href="http://getbootstrap.com/">Bootstrap</a></b> - Framework to develop responsive web pages.</p>
                    <p><b><a href="http://glyphicons.com/">GLYPHICONS</a></b> - Library of monochromatic icons and symbols.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="./about">jemsoar.com</a>
		    </div>
		
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right" role="banner">
		        <li><a href="./about">About</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gallery <b class="caret"></b></a>
		          <ul class="dropdown-menu">
		          	<li><a href="./gallery-menu.php">Gallery Menu</a></li>
       	            <li class="divider"></li>
       	            <?php
       	            	foreach($galleries as $gallery){
       	            		?><li><a href="./gallery.php?id=<?php echo $gallery->id; ?>"><?php echo $gallery->name; ?></a></li><?php
       	            	}
       	            ?>
		          </ul>
		        </li>
	     	    <li><a data-toggle="modal" data-target="#contactModal">Contact</a></li>
	  	        <li><a data-toggle="modal" data-target="#smallPrintModal">Small Print</a></li>
		        <li><a data-toggle="modal" data-target="#linksModal">Links</a></li>  	        
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</div>
	</nav>
	
	<div id="banner">
		<div class="container">
			<h1 class="page-header"><span id="banner-header">Jem Soar</span> <span class="small bannerItem">illustrator</span><span class="bannerItem small">graphic designer</span><span class="bannerItem small">artist</span></h1>
		</div>
	</div>
