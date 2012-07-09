<?php
	require_once(__DIR__.'/../inc/header.php');
?>

		<div class="container">
			<div class="page-header">
  				<h1>Templates Collection <small>Published and draft templates</small></h1>
			</div>
			
			<?php 
				foreach ($templates as $template) {
					?>
				
				<div class="row">				
					<div class="span10">
						<ul class="thumbnails">				
							<li class="span2"><a href="/template?tid=<?php echo $template->id ?>">
								<?php echo $template->name ?>
							</a></li>
							<li class="span2">
								<?php echo $template->status ?>
							</li>
							<li class="span2">
								<?php echo $template->owner ?>
							</li>
							<li class="span2">
								<?php echo $template->thumbnail ?>
							</li>
							<li class="span2">
								<a href="/template?id=<?php echo $template->id ?>"><i class="icon-edit"></i></a>
								<a href="/template?id=<?php echo $template->id ?>"><i class="icon-trash"></i></a>
							</li>
					    </ul>
					</div>
				</div>
			<?php } ?>
		</div>
	</body>
</html>