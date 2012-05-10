<?php
require_once(__DIR__.'/../inc/header.php');

?>


<style type="text/css">


      .dashboard_box {
        margin-bottom:15px;
      }
      .dashboard_box_title {
        width:auto;
        border:1px solid #ddd;
        background:#f7f7f7 url("/img/darkgrain.png");
        padding:10px 15px;
        font-size:18px;
        color:#444;
        text-align: right;
        -moz-border-radius-topleft:4px;
        -moz-border-radius-topright:4px;
      }
      .dashboard_box .dashboard_box_inner {
        -moz-border-radius-bottomleft:4px;
        -moz-border-radius-bottomright:4px;
        border:1px solid #ddd;
        
        padding:10px 15px 10px 15px;
      }
      #bActions{
        text-align: right;
      }
    </style>
<script>

  $('.b').live("click", function(){      
    var oid = $(this).attr('id'); 
    location.href="/blibb?b=" + oid;
  }); 

  $('#bcontainer').live('mouseover', function(){    
    $(this).removeClass().addClass("blhover");
    
  }).live('mouseout', function(){
    $(this).removeClass().addClass("blcontainer");
  });
</script>

<div class="container">

   <div class="page-header">
    <h1 span="8"><?php echo $userspace ?> Blibbs</h1>
    <?php 
        if($owner){ ?>
          <div id="bActions">
            <a href="/newBlibb" class="btn btn-primary">Create a new Blibb</a>
            <a href="/newTemplate" class="btn btn-primary">Create a new Template</a>
          </div>
        
       <?php } ?>
        
      </div>
      <div class="row">
        <div class="span10">
      <?php

        echo  $blbb;
        $i = 0;
        $row = 1;
        $endRow = false;

        foreach($blibbs as $b){          
          echo $b; 
        }
        
       ?>
</div>
          <div class="span2">
            <div class="well" style="padding: 8px 0;">
                  <ul class="nav nav-list">
                    
                    <li class="active"><a href="#">Personal</a></li>
                    <li><a href="#">Groups</a></li>
                    <li><a href="#">Basic</a></li>
                    
                    <li><a href="#">Running</a></li>
                    <li><a href="#">Docs</a></li>
                    <li><a href="#">Team</a></li>
                    <li class="divider"></li>
                    <li><a href="#">New Groups</a></li>
                  </ul>
            </div>
          </div>

    </div>

<?php
require_once(__DIR__.'/../inc/footer.php');
?>