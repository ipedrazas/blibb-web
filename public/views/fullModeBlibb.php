<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<style type="text/css">
      html, body, #main{
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Open Sans', sans-serif;
      }
      
	li{
		
		display: inline;
		list-style-type: none;
		padding-right: 20px;
	}
	a.bNewBlibb{

	background: -webkit-gradient(linear,left top,left bottom,from(#FDA352),to(#FB8F3D));
	border: 1px solid #FB8F3D;
	color: white;
	-webkit-border-radius: 2px;
	-webkit-transition: all 0.2s;

	display: inline-block;
	border-radius: 2px;
	border: 1px solid rgba(0, 0, 0, 0.1);
	height: 27px;
	padding: 0 10px;
	line-height: 26px;
	text-align: center;
	font-size: 11px;
	font-weight: bold;
	vertical-align: middle;
	text-decoration: none;
	cursor: auto;
	margin-left: 120px;
}
</style>
<link rel="stylesheet" href="css/bootstrap.css">
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

 <div id="main" role="main">
	<ul>
		<li><a href="blibb?b=<?php echo $bid ?>" class="bNewBlibb">[:b] List Mode</a></li>
		<li><a href="blibb?b=<?php echo $bid ?>&v=2" class="bNewBlibb">[:b] Accesible Mode</a></li>
		<?php 	
			if(!empty($owner)){
		?>
		<li><a href="addItem?f=1&b=<?php echo $bid ?>"  class="bNewBlibb">Add Item</a></li>
		<?php } ?>
	</ul>
	<script>
		$('a[name=comments]').live("click", function(){	
			event.preventDefault();		 
			var cid = $(this).attr('id');
			var oid = cid.substring(2,cid.length);
			var box = $('#comments');
			$('#item_id').val(oid);

			// get All comments
			$.ajax({
				  url: 'getComment',
				    type: "POST",
						data: {i : oid},
				  	success: function(msg) {
				  		$('#box' + oid).html(msg + box.html());
				  }
				});	
			
			
		}); 

		$('input[name=saveComment]').live("click", function(){	
			var author = $('#comment_author').val();
			var body = $('#comment_body').val();
			var item = $('#item_id').val();
			var bid = $('#b_id').val();

			$.ajax({
				  url: 'saveComment',
				    type: "POST",
						data: {i : item, u: author, b: body, bid: bid},
				  	success: function(msg) {

				  		var preBox = $('#box' + item).html();
				  		$('#box' + item).html(msg + preBox);
				  }
				});	
		}); 
	</script>


	<?php
		
		echo $css;
		echo $content;

		
	?>

	<div id="optionsBox" style="display:none">
		<div id="comments">
			<input type="hidden" name="item_id" id="item_id"/>
			<input type="hidden" name="b_id" id="b_id" value="<?php echo $bid ?>"/>
			<?php if(!empty($owner)){ ?>
				<div id="cAuthor">Author: <?php echo $current_user ?> <input type="hidden" name="comment_author" id="comment_author" value="<?php echo $current_user ?>" /></div>
			<?php }else{ ?>
				<div id="cAuthor">Author: <input type="text" name="comment_author" id="comment_author" /></div>
			<?php } ?>
			<div id="cBody">Comment: <textarea name="comment_body" id="comment_body"></textarea></div>
			<input type="button" value="Post Comment" name="saveComment" />
		</div>
	</div>


<style>
#options a{
	text-decoration: none;
	font-size: 90%;
	padding-top: 30px;	
}


</style>
