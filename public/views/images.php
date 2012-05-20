<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title></title>
		<meta name="description" content="">
		<meta name="author" content="">
		
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.css">
		
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<style type="text/css">

			.navbar-inner {
				border-radius: 0;
				-webkit-border-radius: 0;
				background-color: #B21006;
				background-image: none;
			}

			.book-wraper {
				padding-bottom: 25px;
				margin-bottom: 25px;
				border-bottom: 1px solid #EEE;
				float: left;
				width: 100%;
			}

			.book-wraper ul {
				list-style: none;
				margin-left: 0;
			}

			.ebook-image {
				-webkit-box-shadow: 5px 5px 5px rgba(0, 0, 0, .5);
				box-shadow: 5px 5px 5px rgba(0, 0, 0, .5);
				float: left;
			}

			#addItem-btn {
				margin-right: 10px;
			}

			a {
				color: #9D261D;
				text-decoration: none;
			}

			a:hover {
				color: #5C1611;
				text-decoration: underline;
			}

			.nav-list .active > a, .nav-list .active > a:hover {
				color: white;
				text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);
				background-color: #9D261D;
			}

			.nav > li > a:hover {
				text-decoration: none;
				background-color: #EEE;
			}

			
		</style>
		
	</head>
	
	<body>

		<div class="navbar">
		  <div class="navbar-inner">
		    <div class="container">
		    	<a class="brand" href="#">
				  :blibb
				</a>
		    </div>
		  </div>
		</div>

		<div class="container">

			<div class="page-header">

				<!-- parte que cambia -->

  				<h1>images Collection <small>blablablala make me rich</small>

  					

  					<div class="btn-group pull-right">
					  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					    Change :blibb
					    <span class="caret"></span>
					  </a>
					  <ul class="dropdown-menu">
					    <li><a href="#">:blibb 1</a></li>
					    <li><a href="#">:blibb 2</a></li>
					    <li><a href="#">:blibb 3</a></li>
					  </ul>
					</div>

					<a href="#" id="addItem-btn" class="btn btn-primary pull-right"><i class="icon-plus icon-white"></i> Add Item</a>


  				</h1>
			</div>
			
			
			<div class="row">
				

				<div class="span10">
					<ul class="thumbnails">

						<?php 
							foreach ($pict_ids as $img_id) {
								?>

										
							        <li class="span2">
							          <a href="#" class="thumbnail">
							            <img src="/actions/getImage?i=160x120&id=<?php echo $img_id ?>" alt="">
							          </a>
							        </li>

				        <?php } ?>

				     </ul>
					

				</div>

				<!-- aside tag box -->
				<div class="span2">
					<ul class="nav nav-list well">
						<li class="nav-header">
					 		Tags List
					  	</li>
					  	<li class="active">
					    	<a href="#">All</a>
					  	</li>
					  	<li>
					    	<a href="#">Technology</a>
					  	</li>
					  	<li>
					    	<a href="#">Romantic poems</a>
					  	</li>
					  	<li>
					    	<a href="#">Thrillers</a>
					  	</li>
					  
					</ul>
				</div>
			</div>



			
			



		</div>
		
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-dropdown.js"></script>
		<script type="text/javascript" src="js/bootstrap-tooltip.js"></script>

		<script type="text/javascript">


			$('ul.thumbnail li').click(function(event) {
				console.error(event);
			})
			
			

			$('#follow-button').click(function() {
				if ($('#follow-button').hasClass('btn-success') || $('#follow-button').hasClass('btn-danger')) {
					$('#follow-button').removeClass('btn-success');
					$('#follow-button').removeClass('btn-danger');
					$('#follow-button').html("Follow :blibb");
				} else {
					$('#follow-button').addClass('btn-success');
					$('#follow-button').html("Following");
					
				}
			});

			$('#follow-button').mouseenter(function(event) {
				if ($('#follow-button').hasClass('btn-success')) {
					$('#follow-button').removeClass('btn-success');
					$('#follow-button').addClass('btn-danger');
					$('#follow-button').html("Unfollow");
				}
				
			});

			$('#follow-button').mouseout(function(event) {
				if ($('#follow-button').hasClass('btn-danger')) {
					$('#follow-button').removeClass('btn-danger');
					$('#follow-button').addClass('btn-success');
					$('#follow-button').html("Following");
				}
			});


		</script>

		

		</script>
		
	</body>
	
</html>