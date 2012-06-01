<!doctype html>
<!-- <?php echo $_SERVER['SERVER_NAME']; ?>[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">  
  <title>:blibb, content everywhere! </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/home.css">
  <script src="js/libs/modernizr-2.0.6.min.js"></script>

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
  

</head>

<body>
  <header>
	<img src="img/blibb.png" alt="Blibb">
  </header>
  <div id="main">
	<div id="decorator"></div>
	<div id="intro">
		<h1>Stay tuned, we are launching very soon...</h1>
		<p>Blibb is working hard to launch a new site that's going to revolutionize the way you create and use content. Leave us your email below, and we'll notify you the minute we open the doors.</p>
		<form action="getNotified" method="post" id="notform">
			<fieldset  >	
				<span class="label">Email:</span>
				<input type="text" id="email" name="email" class="text" >
				<div id="error" class="msg error" style="display:none">Please, enter a valid email address.</div>			
			</fieldset>
			<a href="#" class="buttonSend" id="sendButton">Get Notified!</a>
		</form>
		
	</div>
	<div id="points">
		<ul class="points">
			<li>			
				<h2>Create!</h2>
				<p>Creating content is much more than writing a post. Write, aggregate, syndicate, group content.</p>
			</li>
			<li>
				<h2>Share!</h2>
				<p>You don't write the same things for different people so, don't share it all the same way!</p>
			</li>
			<li>
				<h2>Control!</h2>
				<p>Having control of your content is as important as creating good content.</p>
			</li>
		</ul>
		<div class="clear"></div>
		<img class="hrfade" src="img/hr-fade.gif">		
	</div>	
	
  </div>
  <div class="clear"></div>
  <footer>
	<p>For more details leading up to our launch</p>
	<p>
		<a href="https://twitter.com/ipedrazas" >follow us on twitter!</a>
	</p>
  </footer>

  <!-- JavaScript at the bottom for fast page loading -->

<script>             
	jQuery().ready(function() {
			$('input[type="text"]').focus(function() {
				$('#error').hide();
				this.select();
			});
			$('input[type="text"]').mouseup(function(e){
			        e.preventDefault();
			});

			jQuery("#sendButton").click( function(e) {                 
				e.preventDefault();                 
				e.stopPropagation();                 
				var email = $('input#email').val();				
				 $.ajax({
					  url: '/actions/validate',
					    type: "POST",
  						data: {id : email},
					  	success: function(msg) {
					  		
					    	if(msg!='1'){
					   			$('#error').html('Please, enter a valid email address.'); 
					   			$('#error').show();
					   	 	}else{
								jQuery("form").submit();	    	
					    	}
					  }
					});				
			});             
	});             
</script>

  <!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
       mathiasbynens.be/notes/async-analytics-snippet -->
  <script>
    var _gaq=[['_setAccount','UA-1313122-14'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
</body>
  <![endif]-->
</html>