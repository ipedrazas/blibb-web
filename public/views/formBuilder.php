
<?php
	require_once(__DIR__.'/../inc/header.php');

?>
	<script type="text/javascript" src="/js/jquery-ui-1.8.23.custom.min.js"></script>
	<style type="text/css">
		#form-builder {
			min-height: 400px;
		}
		.item-list {
			margin-bottom: 5px;
		}

		legend + .control-group {
			margin-bottom: 0;
			margin-top: 0;
		}

		.form-horizontal .control-group {
			border-bottom: 1px solid #E5E5E5;
			padding-bottom: 20px;
			padding-top: 20px;
			margin-bottom: 0;
		}

		.form-horizontal .control-group:hover {
			background-color: #d9edf7;
		}

		#buttonRack {
			margin-top: 16px;
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
					<input type="hidden" name="template_id" value=""/>
					<fieldset id="form-builder">
						<h2 class="editable" contenteditable="true" id="template_name">Your Template</h2>

					</fieldset>
					<fieldset id="buttonRack">
						<input type="button" id="generateForm" class="btn btn-primary" value="Generate" data-tid="<?php echo $tid; ?>">
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


<script type="text/javascript" src="/js/bootstrap-tooltip.js"></script>
<script type="text/javascript" src="/js/bootstrap-popover.js"></script>
<script type="text/javascript" src="/js/actions.js"></script>

<?php
require_once(__DIR__.'/../inc/footer.php');
?>
