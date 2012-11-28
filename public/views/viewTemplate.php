<?php
require_once(__DIR__.'/../inc/header.php');
?>
<link rel="stylesheet" href="/css/addItem.css">
 <div id="main" role="main">

<ul>
    <li><a href="template?t=<?php echo $tid ?>&v=1">[:b] Full Mode</a></li>
    <li><a href="template?t=<?php echo $tid ?>&v=2">[:b] Accessible Mode</a></li>
  <?php
      if(($owner)){
  ?>
    <!-- <li><a href="editTemplate?b=<?php echo $bid ?>">Edit styleshet</a></li> -->
    <li><a href="addItem?b=<?php echo $tid ?>">Add Item</a></li>
  <?php } ?>
</ul>

<?php
	echo $name . '<br>';

	echo $desc;
?>


</div>
<?php
require_once(__DIR__.'/../inc/footer.php');
?>