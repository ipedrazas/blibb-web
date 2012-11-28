<?php
require_once(__DIR__.'/../inc/header.php');
?>
<link rel="stylesheet" href="/css/addItem.css">
 <div id="main" role="main">

<ul>
    <li><a href="blibb?b=<?php echo $bid ?>&v=1">[:b] Full Mode</a></li>
    <li><a href="blibb?b=<?php echo $bid ?>&v=2">[:b] Accessible Mode</a></li>
  <?php
      if(($owner)){
  ?>
    <li><a href="addItem?b=<?php echo $bid ?>">Add Item</a></li>
  <?php } ?>
</ul>

<?php
	echo $css;		
	echo $content;
?>


</div>
<?php
require_once(__DIR__.'/../inc/footer.php');
?>