<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $blibb['name'] ?>
		</title>
	</head>
	<body>
		<?php					
			$entries = $blibb['ENTRIES'];
			foreach ($entries as $entry) {		
				echo '<h2>New entry</h2>';
				foreach ($entry as $key => $value) {
					echo '<strong>' . $key . '</strong>' . $value . '<br>';
				}
			}
		?>
	</body>
</html>

