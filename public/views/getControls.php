<?php
require_once(__DIR__.'/../inc/header.php');
?>
<link rel="stylesheet" href="css/user.css">
<style>
#nform{
	margin-top: 30px;
}
#controlContainer{
	margin-bottom: 30px;
	width: 85%;
	padding: 10px;
	padding-bottom: 30px;
}
input, textarea{
	width: 66%;
}

#fForm{
	width: 100%;
	margin-top: 50px;
	padding-top: 20px;
	padding-bottom: 10px;
}
#itemplate{
	width: 100%;
	border: 1px solid #FCE4C4;
	padding: 10px;
	margin-top: 30px;
	padding-top: 20px;
	padding-bottom: 10px;
}
.bcontrols{
	margin: 10px;
}
.bControlsActions{
	vertical-align: middle;
	float: right;
}
.templatedCtrl{
	padding-top: 20px;
	padding-bottom: 10px;
}

</style>
<link href="css/fileuploader.css" rel="stylesheet" type="text/css">	
<link type="text/css" href="css/blitzer/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script> 

<script type="text/javascript" charset="utf-8">
	$('a[name=create]').live("click", function(){	
		$('#nform').submit();
	}); 
	
	$('a[name=cancel]').live("click", function(){	
		$('#nform')[ 0 ].reset();
	});


	var tid = '<?php echo $tid ?>';

	// we'll have to save the order... let's start with this
	var numElems = 0;

	// This will load the new Resource
	$('a[name=menuEntry]').live("click", function(){
		numElems++;
		var id = $(this).attr('data-cid');
			$.ajax({
				  url: 'getBlitem',
				    type: "POST",
						data: {c_id: id, t_id: tid},
				  	success: function(msg) {
				  		$('#fForm').append(msg);
				  }
				});
	}); 
	
	

	var post_opts = new Array();

    $("#entryButton").live("click", function(){

        var name =  $("#entryName").val();
        var val =  $("#entryVal").val();
        var select =  document.getElementById('superselect');
        addOption(select,name,val);
        //$("#select-holder").html(select_element);

    });


    function addOption(select, name, value){
        // var _opt = new array();
        // _opt.push(name,value); 
        var opt = new Option(name, value, false, false);
        post_opts.push(name, value);
        select.appendChild(opt);

    }

    var numControls = 0;

	$("a[name=ilu]").live("click", function(){
 		var e = $(this);
		var fid = e.attr('data-cid');
		// var tid = e.attr('data-tid');
		var t = Array();
		$('#'+fid).find('input').each(
			function(){ 
				var value = $(this).attr('value');
				var name = $(this).attr('name');
				// if(value.length > 1 && name.value > 1){
					t.push(name + ':' + value);	
				// }
				
			});
		
		//if(t.length>0){
			var s = '';
			for (var i = 0; i < t.length; i++) {
				s += t[i] + ', ';
			};

			$.ajax({
				  url: 'actions/saveControlData',
				    type: "POST",
						data: {tid : tid, cid: fid, value: s, order: numElems},
				  	success: function(msg) {			  		
				  		numControls++;
				  		$('#fForm').html('');
						$('#itemplate').append(msg);
				  }
				});
		
 	});
</script>

		<div class="container">

			<div class="page-header">
  				<h1>Template Builder</h1>
			</div>
			<div class="row">
				<div class="span8 offset2">
   	        		<form action="editTemplateCss" enctype="multipart/form-data" method="post" id="nform" >
   	        			<fieldset>
						    <legend><?php echo $name ?> <small><?php echo $desc ?></small></legend>
			   	        	<input type="hidden" name="bkey" value="<?php echo $key ?>" /> 
			   	        	<input type="hidden" name="tid" value="<?php echo $tid ?>" /> 
								<ul class="nav nav-pills">
								<?php
									foreach ($r as $key => $value) {									
											$t = json_decode($value,true);
											$oid = $t['_id']; 
											//echo '<li><a class="btn btn-warning" href="#" name="menuEntry"  data-cid="'.$oid['$oid'].'">'.$t['n'].'</a></li>';
											echo '<li class="active"><a href="#" name="menuEntry" data-cid="'.$oid['$oid'].'">'.$t['n'].'</a></li>';

									};
								?>
								<div class="offset1">
									<div id="fForm"></div>
								</div>
								<div class="well personal-form">
									<h2>Your form</h2>
									<div id="itemplate"></div>
								</div>
							
							<div class="">
						    	<input type="reset" id="reset" value="Cancel" class="btn btn-danger">
						    	<input type="submit" id="submit" value="Save" class="btn">
						    </div>
					  </fieldset>
   	        		</form>	
   	        	</div>
   	        </div>


	
<?php
require_once(__DIR__.'/../inc/footer.php');
?>