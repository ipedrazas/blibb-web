<?php
	require_once(__DIR__.'/../inc/header.php');
?>

		<div class="container">
			<div class="page-header">
  				<h1>Controls <small>you can only modify your own controls</small></h1>
			</div>
			

			<table>
				<thead>
				<tr>
				<th>Control Name</th>
				<th>Type</th>
				<th>Button</th>
				<th>Add</th>
				<th>Display</th>
				</tr>
				</thead>
				<tbody>
    			<?php 
					foreach ($controls as $control) {
						?>

						<tr>
						<td>
						<a href="/template?tid=<?php echo $control->id ?>">
						<?php echo $control->name ?>
						</a>
						</td>
						<td>
							<?php echo $control->type ?>
						</td>
						<td>
							<textarea class="input-xlarge" id="02-multi-line-input" rows="5"><?php echo htmlentities($control->button); ?></textarea>
						</td>
						<td>
							<textarea class="input-xlarge" id="02-multi-line-input" rows="5"><?php echo htmlentities($control->ui); ?></textarea>
						</td>
						<td>
							<textarea class="input-xlarge" id="02-multi-line-input" rows="5"><?php echo htmlentities($control->ui); ?></textarea>
						</td>
						
						</tr>
				
				<?php } ?>
				</tbody>
			</table>
			<input type="submit" id="submit" name="create" value="Update" class="btn btn-primary">
		</div>
	</body>
</html>