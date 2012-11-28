<?php

$userName  = current_user();

?><!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>:Blibb, Content Everywhere!</title>
  <meta name="description" content=":Blibb, Content Everywhere!">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width,initial-scale=1">

<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap-responsive.min.css">
<link rel="stylesheet" href="/css/font-awesome.css">
<link href='/css/fonts.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/css/blibb.css">

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->
  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
<script>window.jQuery || document.write('<script src="/js/jquery-1.7.2.min.js"><\/script>')</script>

<script src="/js/modernizr.js"></script>
<script src="/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="navbar">
      <div class="navbar-inner">
        <div class="container">
          <a href="/" class="brand">
           <span class="topTitle">:blibb</span>
          </a>
          <?php
            if(empty($userName)){
           ?>
            <ul class="menu">
              <li><a href="/login">Sign In</a></li>
              <li><a href="/signup">Sign up</a></li>
            </ul>
          <?php }else{ ?>
            <ul class="nav" style="float: right; margin-right: 105px">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $userName ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/profile?p=<?php echo $userName?>">Profile</a></li>
                  <li><a href="/user/<?php echo $userName ?>">UserSpace</a></li>
                  <li><a href="/logout" id="logout">Log Out</a></li>
                </ul>
              </li>
            </ul>
          <?php } ?>
        </div>
      </div>
    </div>

<?php if(!empty($userName)) { ?>
    <script>
      $('#logout').live("click", function(){
        event.preventDefault();
        $("#logoff").submit();
      });

      $('.dropdown-toggle').dropdown();

    </script>
    <form action="/logout" method="post" id="logoff"></form>
  <?php } ?>

