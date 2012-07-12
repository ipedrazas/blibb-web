
<?php
	require_once(__DIR__.'/../inc/header.php');

?>
	<script type="text/javascript" src="/js/jquery-ui-1.8.21.custom.min.js"></script>
	<style type="text/css">
		#form-builder {
			min-height: 400px;
		}
	</style>

	<div class="container">
		<div class="row">
			<div class="span6">
				<ul class="nav nav-pills">
					<?php

						foreach ($controls as $control) {
							$button = $control['button'];
							echo $button;
						}
					
					?>					
				</ul>
			</div>
			

			<div class="span6" >
				<form class="form-horizontal" action="publishTemplate" id="dynForm" method="post">
					<input type="hidden" name="template_id" value="<?php echo $tid ?>" /> 
					<fieldset id="form-builder">
						<legend>Your Form</legend>
						
					</fieldset>
					<fieldset id="buttonRack">
						<input type="button" id="generateForm" class="btn btn-primary" value="Generate">
						<input type="button" id="publishForm" class="btn btn-primary" value="Publish" style="display:none">
					</fieldset>
				</form>
			</div>
		</div>
	</div>

<?php
	foreach ($controls as $control) {
		$ui = $control['ui'];
		echo $ui;
	}

?>

	<script type="text/javascript">
		$('.control').draggable({
			opacity: 0.35,
			revert: true,
			revertDuration: 100
		});


		$( "#form-builder" ).droppable({ accept: ".control" });

		$( "#form-builder" ).bind( "drop", function(event, ui) {
			var link = ui.draggable.children();
			var id = link.attr('data-control');
			var cid = link.attr('data-cid');

			$(this).append($('#'+id).html());

			$('#form-builder .editable').blur(function() {
				var title = $(this).html();
				title = title.toLowerCase();
				var input = $(this).parent().children()[1].children[0];
				input.id = input.id.substring(0,3);
				input.id += title;
			});

		});

		$( ".control" ).bind( "click", function(event, ui) {
			var link = $(this).children();
			var id = link.attr('data-control');
			var cid = link.attr('data-cid');

			$('#form-builder').append($('#'+id).html());

			$('#form-builder .editable').blur(function() {
				var title = $(this).html();
				title = title.toLowerCase();
				title = title.replace(/ /g, '-');
				var input = $(this).parent().children()[1].children[0];
				input.id = input.id.substring(0,3);
				input.id += title;
			});

		});

		$( '#generateForm' ).click(function() {
			var control = [];
			var array = $('#form-builder .control-group');
			for (var i = 0, max = array.length; i < max; i++) {
				c = {};
				c['order'] = i + 1;
				c['name'] = $(array[i]).children()[0].innerHTML;
				c['help'] = $(array[i]).children()[1].children[1].innerHTML;
				c['cid'] = $(array[i]).attr('id');
				c['type'] = $(array[i]).children()[1].children[0].id.substring(0, 2);
				control.push(c);
			}
			$.ajax({
				  url: 'actions/setControlsData',
				    type: "POST",
						data: {control: control, template: '<?php echo $tid; ?>'},
				  	success: function(msg) {
				  		$alert = "<div class='alert alert-success'><a class='close' data-dismiss='alert'>×</a>Template generated succesfully!<br> You can publish it to make it available or leave i as Draft.</div>";
						$('#buttonRack').before($alert);
						$('#publishForm').show();
				  }
				});
		});
		$( '#publishForm' ).click(function() {
			$('#dynForm').submit();
		});


	</script>
<?php
require_once(__DIR__.'/../inc/footer.php');
?>